<?php

use yii\helpers\Html;
use scotthuangzl\googlechart\GoogleChart;
/** @var yii\web\View $this */
/** @var app\models\Analisi $model */

$canto = \app\models\CantoSearch::findOne($model->canto_ID);
$modo = \app\models\ModoSearch::findOne($canto->modo);
$this->title = $canto->nome;
$this->params['breadcrumbs'][] = ['label' => 'Analisi', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="analisi-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Modifica', ['update', 'ID' => $model->ID], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Elimina', ['delete', 'ID' => $model->ID], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <div class="row">
        <div class="col-md-4">Modo: <strong><?php echo $modo->nome; ?></strong></div>
        <div class="col-md-4">Nota iniziale: <strong><?php echo \app\models\Analisi::$note[$model->iniziale]; ?></strong></div>
        <div class="col-md-4">Nota finale: <strong><?php echo \app\models\Analisi::$note[$model->finale]; ?></strong></div>
    </div>
    <div class="row">
        <?php
        if ($canto->url){
            echo '<div class="col-md-12 text-center"><a href="' . $canto->url . '" target="_blank">Scarica il file</a></div>';
    	}
        ?>
        <div class="col-md-12"><?php echo $canto->descrizione; ?></div>
    </div>
    <div class="row">
        <div class="col-xs-12 col-md-6">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Distribuzione delle note</h4>
                    <?php
                    $data =  [
                        ['greg_analisi_note', 'conteggio note']
                    ];
                    $rows = \app\models\AnalisiNoteSearch::find()->where(['analisi_ID' => $model->ID])->all();
                    foreach ($rows as $riga) {
                        $nome = \app\models\Analisi::$note[$riga->nota];
                        $data[] = [$nome, $riga->numero];
                    }
                    if (count($data) > 1) {
                        echo GoogleChart::widget(array('visualization' => 'ColumnChart',
                            'data' => $data,
                            'options' => array('title' => 'Distribuzione delle note')));
                    }
                    ?>
                </div>
            </div>
        </div>
        <div class="col-xs-12 col-md-6">
            <div class="card">
            <div class="card-body">
                <h4 class="card-title">Salti</h4>
            <?php
            $rows = (new \yii\db\Query())
                ->select(['count(ID) as conteggio', 'altezza_id', 'direzione'])
                ->from('greg_salti')
                ->where(['analisi_ID' => $model->ID])
                ->groupBy(['altezza_id', 'direzione'])
                ->all();
            $data = [
                ['greg_salti', 'conteggio']
            ];
            $saltiTotali = 0;
            foreach ($rows as $riga) {
                $nome = \app\models\AltezzaSearch::findOne($riga['altezza_id'])->nome;
                $nome .= ($riga['direzione'] == 1)? ' ascendente' : '     discendente';
                $data[] = [$nome, $riga['conteggio']];
                $saltiTotali += $riga['conteggio'];
            }
            ?>
            <?php

            echo GoogleChart::widget(array('visualization' => 'PieChart',
                'data' => $data,
                'options' => array('title' => 'Distribuzione su ' . $saltiTotali . ' totali')));
            ?>
            </div>
            </div>
        </div>
        <div class="col-xs-12 col-md-6">
            <div class="card">
            <div class="card-body">
                <h4 class="card-title">Salti Discendenti</h4>
            <?php
            $rows = (new \yii\db\Query())
                ->select(['count(ID) as conteggio', 'altezza_id', 'direzione'])
                ->from('greg_salti')
                ->where(['analisi_ID' => $model->ID, 'direzione' => 2])
                ->groupBy(['altezza_id', 'direzione'])
                ->all();
            $data2 = [
                ['greg_salti', 'conteggio']
            ];
            $saltiTotali = 0;
            foreach ($rows as $riga) {
                $nome = \app\models\AltezzaSearch::findOne($riga['altezza_id'])->nome;
                $nome .= ($riga['direzione'] == 1)? ' ascendente' : ' discendente';
                $data2[] = [$nome, $riga['conteggio']];
                $saltiTotali += $riga['conteggio'];
            }
            ?>
            <?php

            echo GoogleChart::widget(array('visualization' => 'PieChart',
                'data' => $data2,
                'options' => array('title' => 'Distribuzione su ' . $saltiTotali . ' totali')));
            ?>
            </div>
            </div>
        </div>
        <div class="col-xs-12 col-md-6">
            <div class="card">
            <div class="card-body">
                <h4 class="card-title">Salti Ascendenti</h4>
            <?php
            $rows = (new \yii\db\Query())
                ->select(['count(ID) as conteggio', 'altezza_id', 'direzione'])
                ->from('greg_salti')
                ->where(['analisi_ID' => $model->ID, 'direzione' => 1])
                ->groupBy(['altezza_id', 'direzione'])
                ->all();
            $data2 = [
                ['greg_salti', 'conteggio']
            ];
            $saltiTotali = 0;
            foreach ($rows as $riga) {
                $nome = \app\models\AltezzaSearch::findOne($riga['altezza_id'])->nome;
                $nome .= ($riga['direzione'] == 1)? ' ascendente' : ' discendente';
                $data2[] = [$nome, $riga['conteggio']];
                $saltiTotali += $riga['conteggio'];
            }
            ?>
            <?php

            echo GoogleChart::widget(array('visualization' => 'PieChart',
                'data' => $data2,
                'options' => array('title' => 'Distribuzione su ' . $saltiTotali . ' totali')));
            ?>
                </div>
            </div>
        </div>
    </div>
    <div class="row" style="padding-top: 10px;">
            <?php
            $rows = (new \yii\db\Query())
                ->select(['count(ID) as conteggio', 'stile_entrata_ID'])
                ->from('greg_salti')
                ->where(['analisi_ID' => $model->ID])
                ->groupBy(['stile_entrata_ID'])
                ->all();
            $data2 = [
                ['stile entrata', 'conteggio']
            ];
            $saltiTotali = 0;
            foreach ($rows as $riga) {
                if (!$riga['stile_entrata_ID']){
                    continue;
                }
                $nome = \app\models\EntrataUscita::findOne($riga['stile_entrata_ID'])->nome;
                $data2[] = [$nome, $riga['conteggio']];
                $saltiTotali += $riga['conteggio'];
            }
            if (count($data2)>1) {
            ?>
        <div class="col-xs-12 col-md-4">
            <div class="card">
            <div class="card-body">
                <h4 class="card-title">Tipologie entrata</h4>

            <?php

            echo GoogleChart::widget(array('visualization' => 'PieChart',
                'data' => $data2,
                'options' => array('title' => 'Distribuzione su ' . $saltiTotali . ' totali')));
            ?>
            </div>
            </div>
        </div>
            <?php
            }
 $rows = (new \yii\db\Query())
                ->select(['count(ID) as conteggio', 'stile_uscita_ID'])
                ->from('greg_salti')
                ->where(['analisi_ID' => $model->ID])
                ->groupBy([ 'stile_uscita_ID'])
                ->all();
            $data2 = [
                ['stile uscita', 'conteggio']
            ];
            $saltiTotali = 0;
            foreach ($rows as $riga) {

                if (!$riga['stile_uscita_ID']){
                    continue;
                }
                if (!$riga['stile_uscita_ID']) {continue;}
                $nome = \app\models\EntrataUscita::findOne($riga['stile_uscita_ID'])->nome;
                $data2[] = [$nome, $riga['conteggio']];
                $saltiTotali += $riga['conteggio'];
            }
            if (count($data2)>1) {
            ?>

        <div class="col-xs-12 col-md-4">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Tipologie uscita</h4>
            <?php

            echo GoogleChart::widget(array('visualization' => 'PieChart',
                'data' => $data2,
                'options' => array('title' =>'Distribuzione su ' . $saltiTotali . ' totali')));
            ?>
                </div>
            </div>
        </div>
        <?php } ?>

        <div class="col-xs-12 col-md-4">
            <div class="card">
            <div class="card-body">
                <h4 class="card-title">Doppi salti</h4>
        <?php
        $rows = (new \yii\db\Query())
            ->select(['doppiosalto'])
            ->from('greg_salti')
            ->where(['analisi_ID' => $model->ID, 'doppiosalto' => 2])
            ->count();
        if ($rows) {
        ?>
             <p>Sono presenti <?php echo $rows; ?> doppi salti</p>

        <?php } else { ?>
            <p>Non sono presenti doppi salti</p>
                <?php } ?>
            </div>
        </div>
    </div>
    </div>
</div>
