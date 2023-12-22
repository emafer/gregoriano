<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\Salto $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="salto-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'analisi_ID')->textInput() ?>

    <?= $form->field($model, 'altezza_id')->textInput() ?>

    <?= $form->field($model, 'direzione')->textInput() ?>

    <?= $form->field($model, 'stile_entrata_ID')->textInput() ?>

    <?= $form->field($model, 'stile_uscita_ID')->textInput() ?>

    <?= $form->field($model, 'doppiosalto')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
