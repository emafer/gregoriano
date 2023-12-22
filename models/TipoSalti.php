<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tipo_salto".
 *
 * @property int $ID
 * @property string $nome
 */
class TipoSalti extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'greg_tipo_salto';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['nome'], 'required'],
            [['nome'], 'string', 'max' => 10],
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
