<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "presentacion".
 *
 * @property int $id_presentacion
 * @property string $descripcion
 * @property int $estado
 * @property string $fecha_creacion
 *
 * @property Pedido[] $pedidos
 * @property Venta[] $ventas
 */
class Presentacion extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'presentacion';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['estado'], 'integer'],
            [['fecha_creacion'], 'safe'],
            [['descripcion'], 'string', 'max' => 100],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_presentacion' => 'Id Presentacion',
            'descripcion' => 'Descripcion',
            'estado' => 'Estado',
            'fecha_creacion' => 'Fecha Creacion',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPedidos()
    {
        return $this->hasMany(Pedido::className(), ['presentacion_id' => 'id_presentacion']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getVentas()
    {
        return $this->hasMany(Venta::className(), ['presentacion_id' => 'id_presentacion']);
    }
}
