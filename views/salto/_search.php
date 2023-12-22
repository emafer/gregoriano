<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\SaltoSearch $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="salto-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'ID') ?>

    <?= $form->field($model, 'analisi_ID') ?>

    <?= $form->field($model, 'altezza_id') ?>

    <?= $form->field($model, 'direzione') ?>

    <?= $form->field($model, 'stile_entrata_ID') ?>

    <?php // echo $form->field($model, 'stile_uscita_ID') ?>

    <?php // echo $form->field($model, 'doppiosalto') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
