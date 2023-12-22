<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Salto $model */

$this->title = 'Crea Salto';
$this->params['breadcrumbs'][] = ['label' => 'Saltos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="salto-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
