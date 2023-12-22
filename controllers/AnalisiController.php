<?php

namespace app\controllers;

use app\models\Analisi;
use app\models\AnalisiNote;
use app\models\AnalisiNoteSearch;
use app\models\AnalisiSearch;
use app\models\Salto;
use app\models\SaltoSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * AnalisiController implements the CRUD actions for Analisi model.
 */
class AnalisiController extends Controller
{
    /**
     * @inheritDoc
     */
    public function behaviors()
    {
        return array_merge(
            parent::behaviors(),
            [
                'verbs' => [
                    'class' => VerbFilter::className(),
                    'actions' => [
                        'delete' => ['POST'],
                    ],
                ],
            ]
        );
    }

    /**
     * Lists all Analisi models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new AnalisiSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Analisi model.
     * @param int $ID ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($ID)
    {
        return $this->render('view', [
            'model' => $this->findModel($ID),
        ]);
    }

    /**
     * Creates a new Analisi model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new Analisi();
        if ($this->request->isPost) {

            if ($model->load($this->request->post()) && $model->save()) {
                $this->salvaSaltiCollegati($model);
                $this->salvaNoteCollegate($model);
                return $this->redirect(['update', 'ID' => $model->ID]);
            }
        } else {
            $model->loadDefaultValues();
            if ($this->request->get('canto_ID')) {
                $model->canto_ID = $this->request->get('canto_ID');
            }
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Analisi model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $ID ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($ID)
    {
        $model = $this->findModel($ID);
        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            $this->salvaSaltiCollegati($model);
            $this->salvaNoteCollegate($model);
            return $this->redirect(['view', 'ID' => $model->ID]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Analisi model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $ID ID
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($ID)
    {
        $analisiNote = \app\models\AnalisiNoteSearch::find()->where(['analisi_ID' => $ID])->all();
        foreach ($analisiNote as $analisNota) {
            $analisNota->delete();
        }
        $salti = \app\models\SaltoSearch::find()->where(['analisi_ID' => $ID])->orderBy('ordine', SORT_ASC)->all();
        foreach ($salti as $salto) {
            $salto->delete();
        }
        $this->findModel($ID)->delete();
        return $this->redirect(['index']);
    }

    /**
     * Finds the Analisi model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $ID ID
     * @return Analisi the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($ID)
    {
        if (($model = Analisi::findOne(['ID' => $ID])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    /**
     * @param Analisi $model
     * @throws \Throwable
     * @throws \yii\db\StaleObjectException
     */
    protected function salvaSaltiCollegati(Analisi $model)
    {
        if (!$this->request->post('salto')) {
            return;
        }
        foreach ($this->request->post('salto') as $ordine => $saltoPost) {
            if ($ordine == 'cambiami') {
                continue;
            }

            if ($saltoPost['id']) {
                $salto = SaltoSearch::findOne($saltoPost['id']);}
            else {$salto = new Salto();}
            $salto->analisi_ID = $model->ID;
            $salto->altezza_id = $saltoPost['altezza'];
            $salto->direzione = $saltoPost['direzione'];
            $salto->stile_entrata_ID = $saltoPost['entrata'];
            $salto->stile_uscita_ID =     $saltoPost['uscita'];
            $salto->doppiosalto = isset($saltoPost['doppiosalto'])? 1:2;
            $salto->ordine = $saltoPost['ordine'];
            $salto->save();
        }
    }

    protected function salvaNoteCollegate(Analisi $model)
    {
        if (!$this->request->post('analisinote')) {
            return;
        }
        foreach ($this->request->post('analisinote') as $analisiPost) {
            if ($analisiPost['ID']) {
                $analisiNota = AnalisiNoteSearch::findOne($analisiPost['ID']);}
            else {
                $analisiNota = new \app\models\AnalisiNote();
                $analisiNota->analisi_ID = $model->ID;
            }
            $analisiNota->nota = $analisiPost['nota'];
            $analisiNota->numero = $analisiPost['numero'];
            $analisiNota->save();
        }
    }
}
