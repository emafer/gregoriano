<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\AnalisiNote $model */

$this->title = 'Create Analisi Note';
$this->params['breadcrumbs'][] = ['label' => 'Analisi Notes', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="analisi-note-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
