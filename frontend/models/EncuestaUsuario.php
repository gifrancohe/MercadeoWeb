<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "encuesta_usuario".
 *
 * @property int $id_encuesta_usuario
 * @property string $respuesta
 * @property string $create_at
 * @property int $usuario_id
 * @property int $encuesta_id
 *
 * @property Encuesta $encuesta
 * @property User $usuario
 */
class EncuestaUsuario extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'encuesta_usuario';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['respuesta', 'create_at', 'usuario_id', 'encuesta_id'], 'required'],
            [['create_at'], 'safe'],
            [['usuario_id', 'encuesta_id'], 'integer'],
            [['respuesta'], 'string', 'max' => 255],
            [['encuesta_id'], 'exist', 'skipOnError' => true, 'targetClass' => Encuesta::className(), 'targetAttribute' => ['encuesta_id' => 'id_encuesta']],
            [['usuario_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['usuario_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_encuesta_usuario' => 'Id Encuesta Usuario',
            'respuesta' => 'Respuesta',
            'create_at' => 'Create At',
            'usuario_id' => 'Usuario ID',
            'encuesta_id' => 'Encuesta ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEncuesta()
    {
        return $this->hasOne(Encuesta::className(), ['id_encuesta' => 'encuesta_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUsuario()
    {
        return $this->hasOne(User::className(), ['id' => 'usuario_id']);
    }
}
