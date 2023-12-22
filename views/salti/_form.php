<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\Salti $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="salti-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'analisi_ID')->textInput() ?>

    <?= $form->field($model, 'altezza_id')->textInput() ?>

    <?= $form->field($model, 'direzione')->textInput() ?>

    <?= $form->field($model, 'numero')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
