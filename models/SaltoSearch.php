<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Salto;

/**
 * SaltoSearch represents the model behind the search form of `app\models\Salto`.
 */
class SaltoSearch extends Salto
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['ID', 'analisi_ID', 'altezza_id', 'direzione', 'stile_entrata_ID', 'stile_uscita_ID', 'doppiosalto'], 'integer'],
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
        $query = Salto::find();

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
            'analisi_ID' => $this->analisi_ID,
            'altezza_id' => $this->altezza_id,
            'direzione' => $this->direzione,
            'stile_entrata_ID' => $this->stile_entrata_ID,
            'stile_uscita_ID' => $this->stile_uscita_ID,
            'doppiosalto' => $this->doppiosalto,
        ]);

        return $dataProvider;
    }
}
