<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "precio".
 *
 * @property int $id_precio
 * @property double $precio
 * @property int $estado
 * @property string $fecha_creacion
 *
 * @property Pedido[] $pedidos
 * @property Venta[] $ventas
 */
class Precio extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'precio';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['precio', 'estado', 'fecha_creacion'], 'required'],
            [['precio'], 'number'],
            [['estado'], 'integer'],
            [['fecha_creacion'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_precio' => 'Id Precio',
            'precio' => 'Precio',
            'estado' => 'Estado',
            'fecha_creacion' => 'Fecha Creacion',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPedidos()
    {
        return $this->hasMany(Pedido::className(), ['precio_id' => 'id_precio']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getVentas()
    {
        return $this->hasMany(Venta::className(), ['precio_id' => 'id_precio']);
    }
}
