<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "venta".
 *
 * @property int $id_venta
 * @property int $tendero_id
 * @property int $producto_id
 * @property int $presentacion_id
 * @property int $precio_id
 * @property int $cantidad
 * @property string $fecha_venta
 *
 * @property Precio $precio
 * @property Presentacion $presentacion
 * @property Producto $producto
 * @property Tendero $tendero
 */
class Venta extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'venta';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['tendero_id', 'producto_id', 'presentacion_id', 'precio_id', 'cantidad', 'fecha_venta'], 'required'],
            [['tendero_id', 'producto_id', 'presentacion_id', 'precio_id', 'cantidad'], 'integer'],
            [['fecha_venta'], 'safe'],
            [['precio_id'], 'exist', 'skipOnError' => true, 'targetClass' => Precio::className(), 'targetAttribute' => ['precio_id' => 'id_precio']],
            [['presentacion_id'], 'exist', 'skipOnError' => true, 'targetClass' => Presentacion::className(), 'targetAttribute' => ['presentacion_id' => 'id_presentacion']],
            [['producto_id'], 'exist', 'skipOnError' => true, 'targetClass' => Producto::className(), 'targetAttribute' => ['producto_id' => 'id_producto']],
            [['tendero_id'], 'exist', 'skipOnError' => true, 'targetClass' => Tendero::className(), 'targetAttribute' => ['tendero_id' => 'id_tendero']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_venta' => 'Id Venta',
            'tendero_id' => 'Tendero',
            'producto_id' => 'Producto',
            'presentacion_id' => 'Presentación',
            'precio_id' => 'Precio',
            'cantidad' => 'Cantidad',
            'fecha_venta' => 'Fecha de Venta',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPrecio()
    {
        return $this->hasOne(Precio::className(), ['id_precio' => 'precio_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPresentacion()
    {
        return $this->hasOne(Presentacion::className(), ['id_presentacion' => 'presentacion_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProducto()
    {
        return $this->hasOne(Producto::className(), ['id_producto' => 'producto_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTendero()
    {
        return $this->hasOne(Tendero::className(), ['id_tendero' => 'tendero_id']);
    }
}
