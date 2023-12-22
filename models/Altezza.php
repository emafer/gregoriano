<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "altezza_salti".
 *
 * @property int $ID
 * @property string $nome
 */
class Altezza extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'greg_altezza_salti';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['nome'], 'required'],
            [['nome'], 'string', 'max' => 30],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'ID' => 'ID',
            'nome' => 'Nome',
        ];
    }
}
