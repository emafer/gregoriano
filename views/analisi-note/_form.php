<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\AnalisiNote $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="analisi-note-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'analisi_ID')->textInput() ?>

    <?= $form->field($model, 'nota')->textInput() ?>

    <?= $form->field($model, 'numero')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
