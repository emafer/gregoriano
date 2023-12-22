<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\EntrataUscita $model */

$this->title = 'Aggiorna Tipologia Entrata/Uscita';
$this->params['breadcrumbs'][] = ['label' => 'Tipologie entrate/uscite', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="entrata-uscita-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
