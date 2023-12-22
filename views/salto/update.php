<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Salto $model */

$this->title = 'Update Salto: ' . $model->ID;
$this->params['breadcrumbs'][] = ['label' => 'Saltos', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->ID, 'url' => ['view', 'ID' => $model->ID]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="salto-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
