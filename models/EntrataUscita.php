<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "entrateUscite".
 *
 * @property int $ID
 * @property string $abbr
 * @property string $nome
 *
 * @property Salti[] $saltis
 * @property Salti[] $saltis0
 */
class EntrataUscita extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'greg_entrateUscite';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['abbr', 'nome'], 'required'],
            [['abbr'], 'string', 'max' => 3],
            [['nome'], 'string', 'max' => 100],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'ID' => 'ID',
            'abbr' => 'Abbr',
            'nome' => 'Nome',
            'nomeCompleto' => 'Nome',
        ];
    }

    public function getNomeCompleto(): string {
        return $this->abbr . ' - ' . $this->nome;
    }
    /**
     * Gets query for [[Saltis]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getSaltis()
    {
        return $this->hasMany(Salto::class, ['stile_entrata_ID' => 'ID']);
    }

    /**
     * Gets query for [[Saltis0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getSaltis0()
    {
        return $this->hasMany(Salti::class, ['stile_uscita_ID' => 'ID']);
    }
}
