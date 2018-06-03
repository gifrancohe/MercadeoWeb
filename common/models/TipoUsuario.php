<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "tipo_usuario".
 *
 * @property int $id_tipo_usuario
 * @property string $tipo_usuario
 * @property int $estado
 * @property string $fecha_creacion
 *
 * @property User[] $users
 * @property Usuario[] $usuarios
 */
class TipoUsuario extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tipo_usuario';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['tipo_usuario', 'estado'], 'required'],
            [['estado'], 'integer'],
            [['fecha_creacion'], 'safe'],
            [['tipo_usuario'], 'string', 'max' => 100],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_tipo_usuario' => 'Id Tipo Usuario',
            'tipo_usuario' => 'Tipo Usuario',
            'estado' => 'Estado',
            'fecha_creacion' => 'Fecha Creacion',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUsers()
    {
        return $this->hasMany(User::className(), ['tipo_usuario_id' => 'id_tipo_usuario']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUsuarios()
    {
        return $this->hasMany(Usuario::className(), ['tipo_usuario_id' => 'id_tipo_usuario']);
    }
}
