<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Altezza $model */

$this->title = 'Update Altezza: ' . $model->ID;
$this->params['breadcrumbs'][] = ['label' => 'Altezzas', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->ID, 'url' => ['view', 'ID' => $model->ID]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="altezza-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
