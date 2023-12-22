<?php

/** @var yii\web\View $this */
/** @var string $content */

use app\assets\AppAsset;
use app\widgets\Alert;
use yii\bootstrap5\Breadcrumbs;
use yii\bootstrap5\Html;
use yii\bootstrap5\Nav;
use yii\bootstrap5\NavBar;

AppAsset::register($this);

$this->registerCsrfMetaTags();
$this->registerMetaTag(['charset' => Yii::$app->charset], 'charset');
$this->registerMetaTag(['name' => 'viewport', 'content' => 'width=device-width, initial-scale=1, shrink-to-fit=no']);
$this->registerMetaTag(['name' => 'description', 'content' => $this->params['meta_description'] ?? '']);
$this->registerMetaTag(['name' => 'keywords', 'content' => $this->params['meta_keywords'] ?? '']);
$this->registerLinkTag(['rel' => 'icon', 'type' => 'image/x-icon', 'href' => Yii::getAlias('@web/favicon.ico')]);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>" class="h-100">
<head>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
    <style>
        .margin-b-5{
            margin-bottom:5px;
        }
        .hidden{display: none;}
        .baseSalto .form-control,
        .baseSalto,
        .baseSalto .btn{
            font-size: 11px;
        }
        .baseSalto {
            padding-bottom: 10px;
        }
        .card.baseSalto {
            margin-bottom: 10px;
        }
        .mmm,
        .rigapari.mmm{
            background-color: #f3a2c3;
        }
        .operazioneRiuscita {
            background-color: #c5f1de;
        }
        .rigapari {
            /*background-color: #ababab;*/
        }

        .rigapari.operazioneRiuscita {
            background-color: #e7fcd8;
        }
    </style>
</head>
<body class="d-flex flex-column h-100">
<?php $this->beginBody() ?>

<header id="header">
    <?php
    NavBar::begin([
        'brandLabel' => Yii::$app->name,
        'brandUrl' => Yii::$app->homeUrl,
        'options' => ['class' => 'navbar-expand-md navbar-dark bg-dark fixed-top']
    ]);
    echo Nav::widget([
        'options' => ['class' => 'navbar-nav'],
        'items' => [
            ['label' => 'Home', 'url' => ['/site/index']],
            ['label' => 'Canti', 'url' => ['/canto/index']],
            ['label' => 'Analisi', 'url' => ['/analisi/index']],
            ['label' => 'Modi', 'url' => ['/modo/index']],
            ['label' => 'Tip. Entrata/Uscita', 'url' => ['/entrata-uscita/index']],
//            Yii::$app->user->isGuest
//                ? ['label' => 'Login', 'url' => ['/site/login']]
//                : '<li class="nav-item">'
//                    . Html::beginForm(['/site/logout'])
//                    . Html::submitButton(
//                        'Logout (' . Yii::$app->user->identity->username . ')',
//                        ['class' => 'nav-link btn btn-link logout']
//                    )
//                    . Html::endForm()
//                    . '</li>'
        ]
    ]);
    NavBar::end();
    ?>
</header>

<main id="main" class="flex-shrink-0" role="main">
    <div class="container">
        <?php if (!empty($this->params['breadcrumbs'])): ?>
            <?= Breadcrumbs::widget(['links' => $this->params['breadcrumbs']]) ?>
        <?php endif ?>
        <?= Alert::widget() ?>
        <?= $content ?>
    </div>
</main>

<footer id="footer" class="mt-auto py-3 bg-light">
    <div class="container">
        <div class="row text-muted">
            <div class="col-md-6 text-center text-md-start">&copy; Me medesimo <?= date('Y') ?></div>
<!--            <div class="col-md-6 text-center text-md-end">--><?php // Yii::powered() ?><!--</div>-->
        </div>
    </div>
</footer>
<?php $this->endBody() ?>
<script>
function isEven (number) {
  return number % 2 === 0;
}
function removeMe(idElement) {
    if (jQuery('.eliminami_' + idElement).hasClass('salvato')){
        eliminaAjax(jQuery('.eliminami_' + idElement));
    } else {
        jQuery('.riga_' + idElement).remove();
    }
}
function removeClass(element, classe){
    jQuery(element).removeClass(classe);
}
function saveMe(id) {
    let analisi_ID = jQuery('#salto_' + id + '_analisi_ID').val();
    let altezza = jQuery('#salto_' + id + '_altezza').val();
    let direzione = jQuery('#salto_' + id + '_direzione').val();
    let entrata = jQuery('#salto_' + id + '_entrata').val();
    let uscita = jQuery('#salto_' + id + '_uscita').val();
    let saltoId = jQuery('#salto_' + id + '_id').val();
    let doppioSalto = jQuery('#salto_' + id + '_doppiosalto').val();
    if (altezza && direzione) {
        $.ajax({
            type: "POST",
            cache: false,
            data:{
                'ID': saltoId,
                'salto': {
                        "analisi_ID": analisi_ID,
                        "ordine": id,
                        "ID": saltoId,
                        'altezza_id': altezza,
                        'direzione': direzione,
                        'stile_entrata_ID': entrata,
                        'stile_uscita_ID': uscita,
                        'doppioSalto': doppioSalto
                }
            },
            url: "<?php echo Yii::$app->getUrlManager()->createUrl("salto/insert");?>",
            dataType: "json",
            success: function(data){
                if (data.response == 'ok') {
                    let newid = data.id;
                    jQuery('#salto_' + id + '_id').val(newid);
                    let fatto = '<div class="tuttoOk-salvato-' + id + '">ok!</div>';
                    jQuery('#salto_' + id + '_nota').html(fatto);
                    jQuery('.riga_' + id).addClass('operazioneRiuscita');
                    jQuery('.eliminami_' + id)
                        .attr('data-element-id', newid)
                        .attr('data-element-count', id)
                        .addClass('eliminami')
                        .addClass('salvato');
                    jQuery('.tuttoOk-salvato-' + id).fadeOut(3000);
                } else {
                    jQuery('.riga_' + id).addClass('mmm');
                    setTimeout(function (){
                        jQuery('.riga_' + id).removeData('mmm');
                    }, 5000
                    );
                }
            }
        });
    }
}
function togli(id) {
    let valore = jQuery('#analisinota_numero_' + id).val()*1;
    if (valore >0) {
        jQuery('#analisinota_numero_' + id).val(valore-1);
    }
}

function aggiungi(id) {
    let valore = jQuery('#analisinota_numero_' + id).val()*1;
        jQuery('#analisinota_numero_' + id).val(valore+1);
}
    jQuery(document).ready(function (){

        jQuery('.addSalto').click(function (){
            let baseSalto = jQuery('.baseSalto').html();
            let count = $('.copiato').length*1+1;
            let color = '';
            let testo = baseSalto.replaceAll("cambiami", count);
            testo = testo.replaceAll("requiredss", "required");
            baseSalto = '<div class="card baseSalto copiato riga_' + count + '"' + color + '>'
                + testo
            + '</div>';


            jQuery('#salto_aggiunto').append(baseSalto);

            jQuery('#salto_' + count + '_altezza').focus();

            if (isEven(count)) {
                jQuery('.riga_' + count).addClass('rigapari');
            }
        });
        $('.eliminami').click(function(){
            eliminaAjax(this);
	});
    })
function eliminaAjax(element){
    if (jQuery(element).hasClass('salvato')) {
        let idRiga = jQuery(element).attr("data-element-count");
        let idSalto =  jQuery(element).attr("data-element-id");
        $.ajax({
            type: "POST",
            cache: false,
            data:{"ID": idSalto},
            url: "<?php echo Yii::$app->getUrlManager()->createUrl("salto/delete");?>&ajax=true&ID=" + idSalto,
            dataType: "json",
            success: function(data){
                jQuery('.riga_' + idRiga).remove();
            }
        });
    } else {
        jQuery(element).parent('div').parent('div.row').parent('div.row').parent('div.card-body').parent('div.card').remove();
    }
}
</script>
</body>
</html>
<?php $this->endPage() ?>
