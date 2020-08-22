<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "shipping".
 *
 * @property int $id
 * @property string|null $origin_full_name
 * @property string|null $origin_contact
 * @property string|null $destination_full_name
 * @property string|null $destination_contact
 * @property int $distance_id
 * @property int $service_type_id
 * @property int $shipping_type_id
 * @property string|null $destination_address
 * @property int|null $destination_sucursal
 * @property float $price
 * @property float $date
 *
 * @property ShippingType $shippingType
 * @property Distance $distance
 * @property ServiceType $serviceType
 * @property ShippingItem[] $shippingItems
 */
class Shipping extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'shipping';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['distance_id', 'service_type_id', 'shipping_type_id', 'price', 'date'], 'required'],
            [['distance_id', 'service_type_id', 'shipping_type_id', 'destination_sucursal'], 'integer'],
            [['price'], 'number'],
            [['origin_full_name', 'origin_contact', 'destination_full_name', 'destination_contact'], 'string', 'max' => 45],
            [['destination_address'], 'string', 'max' => 50],
            [['date'], 'string', 'max' => 20],
            [['shipping_type_id'], 'exist', 'skipOnError' => true, 'targetClass' => ShippingType::className(), 'targetAttribute' => ['shipping_type_id' => 'id']],
            [['distance_id'], 'exist', 'skipOnError' => true, 'targetClass' => Distance::className(), 'targetAttribute' => ['distance_id' => 'id']],
            [['service_type_id'], 'exist', 'skipOnError' => true, 'targetClass' => ServiceType::className(), 'targetAttribute' => ['service_type_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'origin_full_name' => 'Origin Full Name',
            'origin_contact' => 'Origin Contact',
            'destination_full_name' => 'Destination Full Name',
            'destination_contact' => 'Destination Contact',
            'distance_id' => 'Distance ID',
            'service_type_id' => 'Service Type ID',
            'shipping_type_id' => 'Shipping Type ID',
            'destination_address' => 'Destination Address',
            'destination_sucursal' => 'Destination Sucursal',
            'price' => 'Price',
        ];
    }

    /**
     * Gets query for [[ShippingType]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getShippingType()
    {
        return $this->hasOne(ShippingType::className(), ['id' => 'shipping_type_id'])->inverseOf('shippings');
    }

    /**
     * Gets query for [[Distance]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getDistance()
    {
        return $this->hasOne(Distance::className(), ['id' => 'distance_id'])->inverseOf('shippings');
    }

    /**
     * Gets query for [[ServiceType]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getServiceType()
    {
        return $this->hasOne(ServiceType::className(), ['id' => 'service_type_id'])->inverseOf('shippings');
    }

    /**
     * Gets query for [[ShippingItems]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getShippingItems()
    {
        return $this->hasMany(ShippingItem::className(), ['shipping_id' => 'id'])->inverseOf('shipping');
    }
}
