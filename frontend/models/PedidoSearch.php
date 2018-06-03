<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Pedido;

/**
 * PedidoSearch represents the model behind the search form of `app\models\Pedido`.
 */
class PedidoSearch extends Pedido
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_pedido', 'producto_id', 'presentacion_id', 'precio_id', 'tendero_id', 'cantidad'], 'integer'],
            [['fecha_pedido'], 'safe'],
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
        $query = Pedido::find();

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
            'id_pedido' => $this->id_pedido,
            'producto_id' => $this->producto_id,
            'presentacion_id' => $this->presentacion_id,
            'precio_id' => $this->precio_id,
            'tendero_id' => $this->tendero_id,
            'cantidad' => $this->cantidad,
            'fecha_pedido' => $this->fecha_pedido,
        ]);

        return $dataProvider;
    }
}
