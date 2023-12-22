<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Modo $model */

$this->title = 'Crea Modo';
$this->params['breadcrumbs'][] = ['label' => 'Modi', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="modo-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
