<?php

namespace app\controllers;

use app\models\Salto;
use app\models\SaltoSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * SaltoController implements the CRUD actions for Salto model.
 */
class SaltoController extends Controller
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
     * Lists all Salto models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new SaltoSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Salto model.
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
     * Creates a new Salto model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new Salto();

        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {
                return $this->redirect(['view', 'ID' => $model->ID]);
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Salto model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $ID ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($ID)
    {
        $model = $this->findModel($ID);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['view', 'ID' => $model->ID]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }
    public function actionInsert()
    {
        if (!$this->request->isPost) {
            return ;
        }
        if ($this->request->post('ID') && $this->request->post('ID')!= '') {
                $model = $this->findModel($this->request->post('ID'));
        } else {
            $model = new Salto();
        }
        $salto = $this->request->post('salto');
        $model->analisi_ID =$salto['analisi_ID'];
        $model->ordine = $salto['ordine'];
        $model->ID = $salto['ID'];
        $model->stile_uscita_ID = $salto['stile_uscita_ID'];
        $model->stile_entrata_ID = $salto['stile_entrata_ID'];
        $model->direzione = $salto['direzione'];
        $model->altezza_id = $salto['altezza_id'];
        $model->doppiosalto = $salto['doppioSalto'];

            if ($model->save()) {
            return json_encode(['response' => 'ok',
                'id' =>$model->ID
            ]);
        } else {$model->validate();
                $this->request->post('salto');
                return json_encode(['response' => false, 'doppiosalto' => $salto['doppioSalto']]);
            }
    }

    /**
     * Deletes an existing Salto model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $ID ID
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($ID, $ajax= false)
    {
        $this->findModel($ID)->delete();
        if ($ajax) {
           return json_encode(['response' => 'ok'
            ]);
        }

        return $this->redirect(['index']);
    }

    /**
     * Finds the Salto model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $ID ID
     * @return Salto the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($ID)
    {
        if (($model = Salto::findOne(['ID' => $ID])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
