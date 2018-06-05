<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Venta;

/**
 * VentaSearch represents the model behind the search form of `app\models\Venta`.
 */
class VentaSearch extends Venta
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_venta', 'tendero_id', 'producto_id', 'presentacion_id', 'precio_id', 'cantidad'], 'integer'],
            [['fecha_venta'], 'safe'],
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
        
        // add conditions that should always apply here
        $tipo_usuario = Yii::$app->user->identity->tipo_usuario_id;
        if($tipo_usuario == 1) {
            $query = Venta::find();
        }else {
            $tendero = Tendero::find()->where(['user_id' => Yii::$app->user->id])->one();
            if(!empty($tendero)) {
                $query = Venta::find()->where(['tendero_id' => $tendero->id_tendero]);
            }
        }

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
            'id_venta' => $this->id_venta,
            'tendero_id' => $this->tendero_id,
            'producto_id' => $this->producto_id,
            'presentacion_id' => $this->presentacion_id,
            'precio_id' => $this->precio_id,
            'cantidad' => $this->cantidad,
            'fecha_venta' => $this->fecha_venta,
        ]);

        return $dataProvider;
    }
}
