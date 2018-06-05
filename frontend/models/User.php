<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "user".
 *
 * @property int $id
 * @property int $municipio_id
 * @property int $tipo_usuario_id
 * @property string $username
 * @property string $auth_key
 * @property string $password_hash
 * @property string $password_reset_token
 * @property string $email
 * @property int $status
 * @property string $nombre
 * @property string $apellido
 * @property string $cedula
 * @property string $direccion
 * @property string $telefono
 * @property int $created_at
 * @property int $updated_at
 *
 * @property Municipio $municipio
 * @property TipoUsuario $tipoUsuario
 */
class User extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'user';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['municipio_id', 'tipo_usuario_id', 'username', 'auth_key', 'password_hash', 'email', 'nombre', 'apellido', 'cedula', 'created_at', 'updated_at'], 'required'],
            [['municipio_id', 'tipo_usuario_id', 'status', 'created_at', 'updated_at'], 'integer'],
            [['username', 'password_hash', 'password_reset_token', 'email', 'direccion'], 'string', 'max' => 255],
            [['auth_key'], 'string', 'max' => 32],
            [['nombre', 'apellido'], 'string', 'max' => 155],
            [['cedula'], 'string', 'max' => 100],
            [['telefono'], 'string', 'max' => 45],
            [['username'], 'unique'],
            [['email'], 'unique'],
            [['password_reset_token'], 'unique'],
            [['municipio_id'], 'exist', 'skipOnError' => true, 'targetClass' => Municipio::className(), 'targetAttribute' => ['municipio_id' => 'id_municipio']],
            [['tipo_usuario_id'], 'exist', 'skipOnError' => true, 'targetClass' => TipoUsuario::className(), 'targetAttribute' => ['tipo_usuario_id' => 'id_tipo_usuario']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'municipio_id' => 'Municipio',
            'tipo_usuario_id' => 'Tipo Usuario',
            'username' => 'Username',
            'auth_key' => 'Auth Key',
            'password_hash' => 'Password Hash',
            'password_reset_token' => 'Password Reset Token',
            'email' => 'Email',
            'status' => 'Status',
            'nombre' => 'Nombre',
            'apellido' => 'Apellido',
            'cedula' => 'Cedula',
            'direccion' => 'Dirección',
            'telefono' => 'Teléfono',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
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
    public function getTipoUsuario()
    {
        return $this->hasOne(TipoUsuario::className(), ['id_tipo_usuario' => 'tipo_usuario_id']);
    }
}
