<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\TipoSalti $model */

$this->title = 'Crea Tipo Salti';
$this->params['breadcrumbs'][] = ['label' => 'Tipo Saltis', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tipo-salti-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
