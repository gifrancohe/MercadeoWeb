<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "encuesta".
 *
 * @property int $id_encuesta
 * @property string $pregunta
 * @property int $estado
 * @property string $create_at
 *
 * @property EncuestaUsuario[] $encuestaUsuarios
 */
class Encuesta extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'encuesta';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['pregunta', 'estado', 'create_at'], 'required'],
            [['estado'], 'integer'],
            [['create_at'], 'safe'],
            [['pregunta'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_encuesta' => 'Id Encuesta',
            'pregunta' => 'Pregunta',
            'estado' => 'Estado',
            'create_at' => 'Create At',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEncuestaUsuarios()
    {
        return $this->hasMany(EncuestaUsuario::className(), ['encuesta_id' => 'id_encuesta']);
    }
}
