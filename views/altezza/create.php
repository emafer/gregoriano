<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Altezza $model */

$this->title = 'Crea Altezza';
$this->params['breadcrumbs'][] = ['label' => 'Altezzas', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="altezza-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
