<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "outlet".
 *
 * @property int $id_outlet
 * @property int $producto_id
 * @property int $municipio_id
 * @property int $descuento
 * @property int $estado
 * @property string $create_at
 * @property string $update_at
 *
 * @property Municipio $municipio
 * @property Producto $producto
 */
class Outlet extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'outlet';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['producto_id', 'descuento','municipio_id', 'estado', 'create_at', 'update_at'], 'required'],
            [['producto_id', 'municipio_id', 'descuento'], 'integer'],
            [['estado'], 'integer', 'min' => 0, 'max' => 100],
            [['create_at', 'update_at'], 'safe'],
            [['municipio_id'], 'exist', 'skipOnError' => true, 'targetClass' => Municipio::className(), 'targetAttribute' => ['municipio_id' => 'id_municipio']],
            [['producto_id'], 'exist', 'skipOnError' => true, 'targetClass' => Producto::className(), 'targetAttribute' => ['producto_id' => 'id_producto']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_outlet' => 'Id Outlet',
            'producto_id' => 'Producto',
            'municipio_id' => 'Municipio',
            'descuento' => 'Descuento',
            'estado' => 'Estado',
            'create_at' => 'Fecha Creación',
            'update_at' => 'Fecha Actualzación',
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
    public function getProducto()
    {
        return $this->hasOne(Producto::className(), ['id_producto' => 'producto_id']);
    }
}
