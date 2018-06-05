<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "cliente".
 *
 * @property int $id
 * @property int $user_id
 * @property int $municipio_id
 * @property int $tendero_id
 * @property string $nombre
 * @property string $apellido
 * @property string $direccion
 * @property string $telefono
 * @property string $email
 *
 * @property Municipio $municipio
 * @property Tendero $tendero
 * @property User $user
 */
class Cliente extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'cliente';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id', 'municipio_id', 'tendero_id', 'nombre', 'apellido'], 'required'],
            [['user_id', 'municipio_id', 'tendero_id'], 'integer'],
            [['nombre', 'apellido', 'direccion'], 'string', 'max' => 100],
            [['telefono'], 'string', 'max' => 45],
            [['email'], 'string', 'max' => 150],
            [['municipio_id'], 'exist', 'skipOnError' => true, 'targetClass' => Municipio::className(), 'targetAttribute' => ['municipio_id' => 'id_municipio']],
            [['tendero_id'], 'exist', 'skipOnError' => true, 'targetClass' => Tendero::className(), 'targetAttribute' => ['tendero_id' => 'id_tendero']],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_id' => 'Usuario',
            'municipio_id' => 'Municipio',
            'tendero_id' => 'Tendero',
            'nombre' => 'Nombre',
            'apellido' => 'Apellido',
            'direccion' => 'Dirección',
            'telefono' => 'Teléfono',
            'email' => 'Email',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMunicipio()
    {
        return $this->hasOne(Municipio::className(), ['id_municipio' => 'municipio_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTendero()
    {
        return $this->hasOne(Tendero::className(), ['id_tendero' => 'tendero_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }
}
