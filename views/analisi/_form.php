<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\Analisi $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="analisi-form hid">

    <?php $form = ActiveForm::begin();
    $canti = \yii\helpers\ArrayHelper::map(\app\models\Canto::find()->all(), 'ID', 'nome');
    echo $form->field($model, 'canto_ID')->dropDownList($canti, ['placeholder'=> 'seleziona un canto', 'prompt' =>'']);
    ?>
    <div class="container-fluid">
        <div class="row">
            <div class="col-6">
                <?php echo $form->field($model, 'iniziale')->dropDownList(\app\models\Analisi::$note, ['placeholder'=> 'seleziona una nota', 'prompt' =>'']); ?>
            </div>
            <div class="col-6">
                <?php echo $form->field($model, 'finale')->dropDownList(app\models\Analisi::$note, ['placeholder'=> 'seleziona una nota', 'prompt' =>'']); ?>
            </div>
        </div><!-- RIGA NOTE INIZIALI/FINALI -->
        <?php
        /**
         * @param array $noteProtus
         * @return array
         */
        function scorriArray(array $noteProtus): array
        {
            $noteDeuterus = $noteProtus;
            $noteDeuterus[] = array_shift($noteDeuterus);
            return $noteDeuterus;
        }

        if ($model->ID) { ?>
        <div class="row">
            <fieldset>
                <legend>analisi numero di note</legend>
            </fieldset>
            <?php
            $note = [];
            $note['protus'] = [1,2,3,4,5,6,7,0];
            $note['deuterus'] = scorriArray($note['protus']);
            $note['tritus'] = scorriArray($note['deuterus']);
            $note['tetrardus'] = scorriArray($note['tritus']);

            $modo = \app\models\ModoSearch::findone($model->canto->modo)->nome;
            $array = $note['protus'];
            if (strpos(' ' . strtolower($modo), 'deuterus')) {
                $array = $note['deuterus'];
            }
            if (strpos(' ' . strtolower($modo), 'tritus')) {
                $array = $note['tritus'];
            }
            if (strpos(' ' . strtolower($modo), 'tetrardus')) {
                $array = $note['tetrardus'];
            }
            foreach ($array as $notak) {
                if (!$model->isNewRecord) {
                    $analisiNota = \app\models\AnalisiNoteSearch::find()->where(['analisi_ID' => $model->ID,
                        'nota' => $notak])->one();
                    if (!$analisiNota) {
                        $analisiNota = new \app\models\AnalisiNote();
                        $analisiNota->nota = $notak;
                    }
                } else {
                    $analisiNota = new \app\models\AnalisiNote();
                    $analisiNota->nota = $notak;
                }
            ?>
            <div class="col-6 col-md-3" style="padding: 10px">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title text-center"><label for="analisinota_numero_<?php echo $notak; ?>"><?php echo \app\models\Analisi::$note[$notak]; ?></label></h4>
                        <div class="card-text">
                            <input type="hidden" name="analisinote[<?php echo $notak;?>][nota]" value="<?php echo $notak;?>"/>
                            <input id="analisinota_ID_<?php echo $notak; ?>" type="hidden" name="analisinote[<?php echo $notak;?>][ID]" value="<?php echo $analisiNota->ID; ?>"/>
                            <input id="analisinota_analisi_ID_<?php echo $notak; ?>" type="hidden" name="analisinote[<?php echo $notak;?>][analisi_ID]" value="<?php echo $analisiNota->analisi_ID; ?>"/>
                            <input id="analisinota_numero_<?php echo $notak; ?>" type="number" min="0" class="text-center form-control" name="analisinote[<?php echo $notak;?>][numero]" value="<?php echo $analisiNota->numero? : 0;?>"/>
                            <div class="col-12 btn-group" role="group" aria-label="Basic example">
                                <a class="btn btn-large btn-warning" onclick="togli(<?php echo $notak; ?>)">-</a><a class="btn btn-success" onclick="aggiungi(<?php echo $notak; ?>)">+</a>
                            </div>
                        </div>
                    </div>
                </div>
                </div>
            <?php
            }
            ?>
        </div>
        </div>
    </div>
    <fieldset>
        <legend>Analisi salti</legend>
        <div class="container-fluid">
    <?php

    $saltoBase =  new \app\models\Salto();
    $saltoBase->analisi_ID = $model->ID;
    $salti = [];
    if (!$model->isNewRecord) {
            $salti = \app\models\SaltoSearch::find()->where(['analisi_ID' => $model->ID])->orderBy('ordine', SORT_ASC)->all();
    }
   $k=0;
   $altezze = \yii\helpers\ArrayHelper::map(\app\models\AltezzaSearch::find()->all(), 'ID', 'nome');
    $entrateUscite = \yii\helpers\ArrayHelper::map(\app\models\EntrataUscitaSearch::find()->all(), 'ID', 'nomeCompleto');
    $lastNota = printFormSalto($saltoBase, 'cambiami', $entrateUscite, $altezze, $form, $model->iniziale, true);

    foreach ($salti as $salto) {
    $lastNota = printFormSalto($salto, $k, $entrateUscite, $altezze, $form, $lastNota);
    $k++;
    }
    ?>
        </div>
        <div class="container-fluid" id="salto_aggiunto"></div>
        <?php  echo Html::button('Aggiungi Salto', ['class' => 'addSalto btn btn-info']); ?>
    </fieldset>
<?php } ?>
    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>
    <?php ActiveForm::end(); ?>
</div>
<?php
function selected($val, $check, $checked=false) {
    if ($val == $check) {
        if ($checked){
            return ' checked="checked"';
        }
        return ' selected="selected"';
    }
    return '';
}
function printFormSalto(\app\models\Salto $salto, $k, array $entrateUscite, array $altezze, $form, $ultimaNota, $hidden = false) {

    $classe = '';
    $required = 'required="required"';
    if ($hidden) {
        $classe = ' hidden';
        $required = 'requiredss="required"';
    } else {
        $classe = ' copiato riga_' . ($k+1);
        $k++;
    }
    if ((int)$k % 2 == 0) {
        $classe .= ' rigapari';
    }
    echo '
    <div class="card baseSalto' .$classe .'">
    <div class="numeroRigaVisibile" style="padding:2px;">' . $k .'</div>
    <div class="card-body"> 
    <div class="cointaner">
    <div class="row">
    <div class="col-6 col-md-2 margin-b-5">
     <select id="salto_' . $k .'_altezza" class="form-control saltoAltezza" onchange="saveMe(' . $k . ');" name="salto[' . $k .'][altezza]" ' . $required . ' aria-required="true">
            <option value>intervallo</option>
        ';
        foreach ($altezze as $key => $nome) {
            echo '<option value="' . $key . '"'. selected($key, $salto->altezza_id) . '>' . $nome . '</option>';
        }
    echo '
        </select>
</div>
    <div class="col-6 col-md-2 margin-b-5"> 
        <select id="salto_' . $k .'_direzione" class="form-control saltoDirezione" onchange="saveMe(' . $k . ');" name="salto[' . $k .'][direzione]" aria-required="true" ' . $required . '>
            <option value><em>Direzione</em></option>
            <option value="1"'. selected(1, $salto->direzione) . '>&#x2191; Ascendente</option>
            <option value="2"'. selected(2, $salto->direzione) . '>&#x2193; Discendente</option>
        </select>
    </div>
    <div class="col-6 col-md-2 margin-b-5">
        <select id="salto_' . $k .'_entrata" class="form-control saltoEntrata"  onchange="saveMe(' . $k . ');" name="salto[' . $k .'][entrata]">
    <option value="">entrata</option>
    ';
    foreach ($entrateUscite as $key => $nome) {
        echo '<option value="' . $key . '"'. selected($key, $salto->stile_entrata_ID) . '>' . $nome . '</option>';
    }
    echo '
        </select>
        <input type="hidden" id="salto_' . $k .'_id" name="salto[' . $k .'][id]" value="' . $salto->ID . '">
        <input type="hidden" id="salto_' . $k .'_analisi_ID" name="salto[' . $k .'][analisi_ID]" value="' . $salto->analisi_ID . '">
        <input type="hidden" class="ordineSalto" id="salto_' . $k .'_ordine" name="salto[' . $k .'][ordine]" value="' . $k . '">
    </div> 
    <div class="col-6 col-md-2 margin-b-5">
     <select id="salto_' . $k .'_uscita" class="form-control saltoUscita" name="salto[' . $k .'][uscita]" aria-required="false" onchange="saveMe(' . $k . ');">
    <option value="">uscita</option>
    ';
    foreach ($entrateUscite as $key => $nome) {
        echo '<option value="' . $key . '"'. selected($key, $salto->stile_uscita_ID) . '>' . $nome . '</option>';
    }
    echo '
        </select>
    </div>
    <div class="col-6 col-md-2 margin-b-5" >
   <label for="salto_' . $k .'_doppiosalto">DoppioSalto? </label><select id="salto_' . $k .'_doppiosalto" class="form-control saltoDoppiosalto" name="salto[' . $k .'][doppiosalto]"  onchange="saveMe(' . $k . ');">
        <option value="1"'. selected($salto->doppiosalto, 1) .'>NO</option>
        <option value="2"'. selected($salto->doppiosalto, 2) .'>SI</option>
    </select>
        ';
    echo '<span class="notaLocale" id="salto_' . $k .'_nota">';
    echo '</span></div>';
    if (!$hidden) {
    	echo '<div class="col-6 col-md-2 margin-b-5" ><a class="eliminami eliminami_' .$k . ' btn btn-danger' . ($salto->ID? ' salvato' : "") . '" data-element-id="' . $salto->ID . '" data-element-count="' . $k . '">'
            .'Elimina</a></div>';
    } else {
    	echo '<div class="col-6 col-md-2 margin-b-5" ><a class="btn btn-danger eliminami_' .$k . '" onClick="removeMe(' . $k .');">Elimina</a></span></div>';
    }
    echo '
    </div>
    </div>
    </div>
</div>';
    
    return $ultimaNota;
}
?>
