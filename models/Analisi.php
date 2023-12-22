<?php

namespace app\models;

use Yii;
use yii\helpers\BaseVarDumper;

/**
 * This is the model class for table "analisi".
 *
 * @property int $ID
 * @property int $canto_ID
 * @property int $iniziale
 * @property int $finale
 */
class Analisi extends \yii\db\ActiveRecord
{

    public static $note = [
        0 => 'DO',
        1 => 'RE',
        2 => 'MI',
        3 => 'FA',
        4 => 'SOL',
        5 => 'LA',
        6 => 'SI',
        7 => 'SIb',
    ];
        public static $direzioni = [
        1 => 'Ascendente',
        2 => 'Discendente',
    ];
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'greg_analisi';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['canto_ID', 'iniziale', 'finale'], 'required'],
            [['canto_ID', 'iniziale', 'finale'], 'integer'],
        ];
    }

    public function getStampaNotaIniziale(): string
    {
        return self::$note[$this->iniziale];
    }

    public function getStampaNotaFinale() : string
        {
        return self::$note[$this->finale];
    }
    public function getCantoNome() {
        if ($this->canto_ID) {
            return CantoSearch::findOne($this->canto_ID)->nome;
        }
        return '';
    }
    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'ID' => 'ID',
            'cantoNome' => 'Canto',
            'canto_ID' => 'Canto',
            'stampaNotaIniziale' => 'Nota iniziale',
            'stampaNotaFinale' => 'Nota finale',
        ];
    }
    /**
     * Gets query for [[Canto]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCanto()
    {
        return $this->hasOne(Canto::class, ['ID' => 'canto_ID']);
    }
}
