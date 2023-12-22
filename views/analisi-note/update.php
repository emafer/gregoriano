<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\AnalisiNote $model */

$this->title = 'Update Analisi Note: ' . $model->ID;
$this->params['breadcrumbs'][] = ['label' => 'Analisi Notes', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->ID, 'url' => ['view', 'ID' => $model->ID]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="analisi-note-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
