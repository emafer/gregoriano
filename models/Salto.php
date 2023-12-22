<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "salti".
 *
 * @property int $ID
 * @property int $analisi_ID
 * @property int $altezza_id
 * @property int $direzione 1= ascendente
 2=discendente
 * @property int $stile_entrata_ID
 * @property int $stile_uscita_ID
 * @property int $doppiosalto
 *
 * @property AltezzaSalti $altezza
 * @property Analisi $analisi
 * @property EntrateUscite $stileEntrata
 * @property EntrateUscite $stileUscita
 */
class Salto extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'greg_salti';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['analisi_ID', 'altezza_id', 'direzione', 'ordine'], 'required'],
            [['analisi_ID', 'altezza_id', 'direzione', 'stile_entrata_ID', 'stile_uscita_ID', 'doppiosalto', 'ordine'], 'integer'],
            [['altezza_id'], 'exist', 'skipOnError' => true, 'targetClass' => Altezza::class, 'targetAttribute' => ['altezza_id' => 'ID']],
            [['analisi_ID'], 'exist', 'skipOnError' => true, 'targetClass' => Analisi::class, 'targetAttribute' => ['analisi_ID' => 'ID']],
            [['stile_entrata_ID'], 'exist', 'skipOnError' => true, 'targetClass' => EntrataUscita::class, 'targetAttribute' => ['stile_entrata_ID' => 'ID']],
            [['stile_uscita_ID'], 'exist', 'skipOnError' => true, 'targetClass' => EntrataUscita::class, 'targetAttribute' => ['stile_uscita_ID' => 'ID']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'ID' => 'ID',
            'ordine' => 'Ordine',
            'analisi_ID' => 'Analisi ID',
            'altezza_id' => 'Altezza ID',
            'direzione' => 'Direzione',
            'stile_entrata_ID' => 'Stile Entrata ID',
            'stile_uscita_ID' => 'Stile Uscita ID',
            'doppiosalto' => 'Doppiosalto',
        ];
    }

    /**
     * Gets query for [[Altezza]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getAltezza()
    {
        return $this->hasOne(Altezza::class, ['ID' => 'altezza_id']);
    }

    /**
     * Gets query for [[Analisi]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getAnalisi()
    {
        return $this->hasOne(Analisi::class, ['ID' => 'analisi_ID']);
    }

    /**
     * Gets query for [[StileEntrata]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getStileEntrata()
    {
        return $this->hasOne(EntrateUscite::class, ['ID' => 'stile_entrata_ID']);
    }

    /**
     * Gets query for [[StileUscita]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getStileUscita()
    {
        return $this->hasOne(EntrateUscite::class, ['ID' => 'stile_uscita_ID']);
    }
}
