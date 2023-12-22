<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\EntrataUscita $model */

$this->title = 'Crea Tipologia Entrata/Uscita';
$this->params['breadcrumbs'][] = ['label' => 'Tipologie entrate/uscite', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="entrata-uscita-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
