<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Analisi;

/**
 * AnalisiSearch represents the model behind the search form of `app\models\Analisi`.
 */
class AnalisiSearch extends Analisi
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['ID', 'canto_ID', 'iniziale', 'finale'], 'integer'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = Analisi::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'ID' => $this->ID,
            'canto_ID' => $this->canto_ID,
            'iniziale' => $this->iniziale,
            'finale' => $this->finale,
        ]);

        return $dataProvider;
    }
}
