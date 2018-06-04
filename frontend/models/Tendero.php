<?php

namespace app\models;

use Yii;
use common\models\User;

/**
 * This is the model class for table "tendero".
 *
 * @property int $id_tendero
 * @property int $municipio_id
 * @property int $punto_venta_id
 * @property int $user_id
 * @property string $nombre
 * @property string $nit
 * @property string $direccion
 * @property string $telefono
 *
 * @property Pedido[] $pedidos
 * @property Municipio $municipio
 * @property PuntoVenta $puntoVenta
 * @property Venta[] $ventas
 */
class Tendero extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tendero';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['municipio_id', 'punto_venta_id', 'user_id', 'nombre', 'nit', 'direccion', 'telefono'], 'required'],
            [['municipio_id', 'punto_venta_id', 'user_id'], 'integer'],
            [['nombre'], 'string', 'max' => 155],
            [['nit', 'direccion', 'telefono'], 'string', 'max' => 45],
            [['municipio_id'], 'exist', 'skipOnError' => true, 'targetClass' => Municipio::className(), 'targetAttribute' => ['municipio_id' => 'id_municipio']],
            [['punto_venta_id'], 'exist', 'skipOnError' => true, 'targetClass' => PuntoVenta::className(), 'targetAttribute' => ['punto_venta_id' => 'id_punto_venta']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_tendero' => 'Id Tendero',
            'municipio_id' => 'Municipio',
            'punto_venta_id' => 'Punto Venta',
            'user_id' => 'Usuario',
            'nombre' => 'Nombre',
            'nit' => 'Nit',
            'direccion' => 'Dirección',
            'telefono' => 'Teléfono',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPedidos()
    {
        return $this->hasMany(Pedido::className(), ['tendero_id' => 'id_tendero']);
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
    public function getPuntoVenta()
    {
        return $this->hasOne(PuntoVenta::className(), ['id_punto_venta' => 'punto_venta_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getVentas()
    {
        return $this->hasMany(Venta::className(), ['tendero_id' => 'id_tendero']);
    }
}
