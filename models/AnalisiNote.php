<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "greg_analisi_note".
 *
 * @property int $ID
 * @property int $analisi_ID
 * @property int $nota 0 => 'DO',
         1 => 'RE',
         2 => 'MI',
         3 => 'FA',
         4 => 'SOL',
         5 => 'LA',
         6 => 'SI',
 * @property int $numero
 *
 * @property Analisi $analisi
 */
class AnalisiNote extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'greg_analisi_note';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['analisi_ID', 'nota', 'numero'], 'required'],
            [['analisi_ID', 'nota', 'numero'], 'integer'],
            [['analisi_ID'], 'exist', 'skipOnError' => true, 'targetClass' => Analisi::class, 'targetAttribute' => ['analisi_ID' => 'ID']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'ID' => 'ID',
            'analisi_ID' => 'Analisi ID',
            'nota' => 'Nota',
            'numero' => 'Numero',
        ];
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
}
