<?php

/** @var yii\web\View $this */

$this->title = 'Statistiche Gregoriane';
?>
<div class="site-index">

    <div class="jumbotron text-center bg-transparent mt-5 mb-5">
        <h1 class="display-4">Statistiche gregoriane</h1>

    </div>

    <div class="body-content">

        <div class="row">
            <div class="col-lg-6 mb-6">
                <h2>Elenco canti inseriti</h2>
                <?php
                $totale = \app\models\CantoSearch::find()->count();
                ?>
                <p>Al momento sono presenti <?php echo $totale; ?> canto/i</p>

                <p><a class="btn btn-outline-secondary" href="/web/index.php?r=canto">Vedi elenco</a></p>
            </div>
            <div class="col-lg-6 mb-6">
                <h2>Analisi</h2>
                <?php
                $totale = \app\models\AnalisiSearch::find()->count();
                ?>
                <p>Al momento sono presenti <?php echo $totale; ?> analisi</p>

                <p><a class="btn btn-outline-secondary" href="/web/index.php?r=analisi">Vedi elenco</a></p>
            </div>
        </div>

    </div>
</div>
