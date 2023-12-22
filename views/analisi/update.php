<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Analisi $model */

$this->title = 'Aggiorna Analisi: ' . $model->getCantoNome();
$this->params['breadcrumbs'][] = ['label' => 'Analisi', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->getCantoNome(), 'url' => ['view', 'ID' => $model->ID]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="analisi-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
