<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "municipio".
 *
 * @property int $id_municipio
 * @property int $departamento_id
 * @property string $municipio
 * @property int $estado
 *
 * @property Cliente[] $clientes
 * @property Departamento $departamento
 * @property PuntoVenta[] $puntoVentas
 * @property Tendero[] $tenderos
 * @property User[] $users
 * @property Usuario[] $usuarios
 */
class Municipio extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'municipio';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['departamento_id', 'municipio'], 'required'],
            [['departamento_id', 'estado'], 'integer'],
            [['municipio'], 'string', 'max' => 255],
            [['departamento_id'], 'exist', 'skipOnError' => true, 'targetClass' => Departamento::className(), 'targetAttribute' => ['departamento_id' => 'id_departamento']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_municipio' => 'Id Municipio',
            'departamento_id' => 'Departamento ID',
            'municipio' => 'Municipio',
            'estado' => 'Estado',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getClientes()
    {
        return $this->hasMany(Cliente::className(), ['municipio_id' => 'id_municipio']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDepartamento()
    {
        return $this->hasOne(Departamento::className(), ['id_departamento' => 'departamento_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPuntoVentas()
    {
        return $this->hasMany(PuntoVenta::className(), ['municipio_id' => 'id_municipio']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTenderos()
    {
        return $this->hasMany(Tendero::className(), ['municipio_id' => 'id_municipio']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUsers()
    {
        return $this->hasMany(User::className(), ['municipio_id' => 'id_municipio']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUsuarios()
    {
        return $this->hasMany(Usuario::className(), ['municipio_id' => 'id_municipio']);
    }
}
