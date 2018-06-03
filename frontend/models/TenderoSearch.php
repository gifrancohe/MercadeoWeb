<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Tendero;

/**
 * TenderoSearch represents the model behind the search form of `app\models\Tendero`.
 */
class TenderoSearch extends Tendero
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_tendero', 'municipio_id', 'punto_venta_id', 'user_id'], 'integer'],
            [['nombre', 'nit', 'direccion', 'telefono'], 'safe'],
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
        $query = Tendero::find();

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
            'id_tendero' => $this->id_tendero,
            'municipio_id' => $this->municipio_id,
            'punto_venta_id' => $this->punto_venta_id,
            'user_id' => $this->user_id,
        ]);

        $query->andFilterWhere(['like', 'nombre', $this->nombre])
            ->andFilterWhere(['like', 'nit', $this->nit])
            ->andFilterWhere(['like', 'direccion', $this->direccion])
            ->andFilterWhere(['like', 'telefono', $this->telefono]);

        return $dataProvider;
    }
}
