<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Canto $model */

$this->title = 'Aggiorna canto: ' . $model->nome;
$this->params['breadcrumbs'][] = ['label' => 'Canti', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->nome, 'url' => ['view', 'ID' => $model->ID]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="canto-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
