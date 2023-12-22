<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Salti $model */

$this->title = 'Update Salti: ' . $model->ID;
$this->params['breadcrumbs'][] = ['label' => 'Saltis', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->ID, 'url' => ['view', 'ID' => $model->ID]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="salti-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
