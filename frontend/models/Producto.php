<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "producto".
 *
 * @property int $id_producto
 * @property string $nombre
 * @property int $estado
 * @property string $fecha_creacion
 *
 * @property Pedido[] $pedidos
 * @property Venta[] $ventas
 */
class Producto extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'producto';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['nombre', 'estado', 'fecha_creacion'], 'required'],
            [['estado'], 'integer'],
            [['fecha_creacion'], 'safe'],
            [['nombre'], 'string', 'max' => 150],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_producto' => 'Id Producto',
            'nombre' => 'Nombre',
            'estado' => 'Estado',
            'fecha_creacion' => 'Fecha Creacion',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPedidos()
    {
        return $this->hasMany(Pedido::className(), ['producto_id' => 'id_producto']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getVentas()
    {
        return $this->hasMany(Venta::className(), ['producto_id' => 'id_producto']);
    }
}
