<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Encuesta;

/**
 * EncuestaSearch represents the model behind the search form of `app\models\Encuesta`.
 */
class EncuestaSearch extends Encuesta
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_encuesta', 'estado'], 'integer'],
            [['pregunta', 'create_at'], 'safe'],
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
        $query = Encuesta::find();

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
            'id_encuesta' => $this->id_encuesta,
            'estado' => $this->estado,
            'create_at' => $this->create_at,
        ]);

        $query->andFilterWhere(['like', 'pregunta', $this->pregunta]);

        return $dataProvider;
    }
}
