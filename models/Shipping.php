<?php

namespace app\models;

use Yii;
use yii\behaviors\TimestampBehavior;

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
            [['distance_id', 'service_type_id', 'shipping_type_id', 'price', 'status', 'payment_at_origin'], 'required'],
            [['distance_id', 'service_type_id', 'shipping_type_id', 'origin_branch_office', 'destination_branch_office', 'status', 'payment_at_origin', 'sender_identification_id', 'receiver_identification_id'], 'integer'],
            [['price'], 'number'],
            [['origin_full_name', 'origin_contact', 'destination_full_name', 'destination_contact'], 'string', 'max' => 45],
            [['destination_address'], 'string', 'max' => 50],
            [['date'], 'string', 'max' => 20],
            [['shipping_type_id'], 'exist', 'skipOnError' => true, 'targetClass' => ShippingType::className(), 'targetAttribute' => ['shipping_type_id' => 'id']],
            [['distance_id'], 'exist', 'skipOnError' => true, 'targetClass' => Distance::className(), 'targetAttribute' => ['distance_id' => 'id']],
            [['service_type_id'], 'exist', 'skipOnError' => true, 'targetClass' => ServiceType::className(), 'targetAttribute' => ['service_type_id' => 'id']],
            [['origin_branch_office'], 'exist', 'skipOnError' => true, 'targetClass' => BranchOffice::className(), 'targetAttribute' => ['origin_branch_office' => 'id']],
            [['destination_branch_office'], 'exist', 'skipOnError' => true, 'targetClass' => BranchOffice::className(), 'targetAttribute' => ['destination_branch_office' => 'id']],
            [['sender_identification_id'], 'exist', 'skipOnError' => true, 'targetClass' => Identification::className(), 'targetAttribute' => ['sender_identification_id' => 'id']],
            [['receiver_identification_id'], 'exist', 'skipOnError' => true, 'targetClass' => Identification::className(), 'targetAttribute' => ['sender_identification_id' => 'id']],

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
            'origin_address' => 'Origin Address',
            'destination_address' => 'Destination Address',
            'origin_branch_office' => 'Origin Branch Office',
            'destination_branch_office' => 'Destination Branch Office',
            'price' => 'Price',
            'status' => 'Status',
            'sender_identification_id' => 'Sender Identification ID',
            'receiver_identification_id' => 'Receiver Identification ID',
        ];
    }

    public function behaviors() {
        return [
            [
                'class' => TimestampBehavior::className(),
                'createdAtAttribute' => 'date',
                'updatedAtAttribute' => false,
            ],
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

    /**
     * Gets query for [[OriginBranchOffice]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getOriginBranchOffice()
    {
        return $this->hasOne(BranchOffice::className(), ['id' => 'origin_branch_office'])->inverseOf('shippings0');
    }

    /**
     * Gets query for [[DestinationBranchOffice]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getDestinationBranchOffice()
    {
        return $this->hasOne(BranchOffice::className(), ['id' => 'destination_branch_office'])->inverseOf('shippings');
    }

    public function getSenderIdentification()
    {
        return $this->hasOne(Identification::className(), ['id' => 'sender_identification_id'])->inverseOf('shippings');
    }

    public function getReceiverIdentification()
    {
        return $this->hasOne(Identification::className(), ['id' => 'receiver_identification_id'])->inverseOf('shippings0');
    }

    public function fields() {
        $fields = parent::fields();

        unset( $fields['shipping_type_id'],
               $fields['distance_id'],
               $fields['service_type_id'],
               $fields['destination_branch_office'],
               $fields['origin_branch_office'],
               $fields['sender_identification_id'],
               $fields['receiver_identification_id']
              );

        $fields['status'] = function(){
          return Status::getExtended($this->status);
        };

        $fields['sender_identification'] = function() {
          return $this->senderIdentification;
        };

        $fields['receiver_identification'] = function() {
          return $this->receiverIdentification;
        };

        return $fields;
    }

    public function extraFields() {
        return [ 'originBranchOffice',
                 'serviceType',
                 'destinationBranchOffice',
                 'shippingType',
                 'shippingItems',
                 'distance'
               ];
    }
}
