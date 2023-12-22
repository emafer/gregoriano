<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\Canto $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="canto-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'nome')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'url')->textInput() ?>

    <?= $form->field($model, 'descrizione')->textarea(['rows' => 6]) ?>
    <?php
    $items = \yii\helpers\ArrayHelper::map(\app\models\Modo::find()->all(), 'ID', 'nome');
    echo $form->field($model, 'modo')->dropDownList($items, ['placeholder'=> 'seleziona un modo', 'prompt' =>'']);
    ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
