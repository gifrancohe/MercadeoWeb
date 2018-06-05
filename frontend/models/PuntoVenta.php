<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "punto_venta".
 *
 * @property int $id_punto_venta
 * @property int $municipio_id
 * @property string $nombre
 * @property string $nit
 * @property string $direccion
 * @property string $telefono
 * @property string $barrio
 *
 * @property Municipio $municipio
 * @property Tendero[] $tenderos
 */
class PuntoVenta extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'punto_venta';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['municipio_id', 'nombre', 'nit'], 'required'],
            [['municipio_id'], 'integer'],
            [['nombre', 'direccion', 'barrio'], 'string', 'max' => 155],
            [['nit', 'telefono'], 'string', 'max' => 45],
            [['municipio_id'], 'exist', 'skipOnError' => true, 'targetClass' => Municipio::className(), 'targetAttribute' => ['municipio_id' => 'id_municipio']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_punto_venta' => 'Id Punto Venta',
            'municipio_id' => 'Municipio',
            'nombre' => 'Nombre',
            'nit' => 'Nit',
            'direccion' => 'Direccion',
            'telefono' => 'Telefono',
            'barrio' => 'Barrio',
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
    public function getTenderos()
    {
        return $this->hasMany(Tendero::className(), ['punto_venta_id' => 'id_punto_venta']);
    }
}
