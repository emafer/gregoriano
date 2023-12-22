<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Canto $model */

$this->title = 'Crea Canto';
$this->params['breadcrumbs'][] = ['label' => 'Canti', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="canto-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
