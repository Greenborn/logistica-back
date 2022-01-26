<?php

namespace app\modules\v1\models;

use Yii;

/**
 * This is the model class for table "shipping_item".
 *
 * @property int $id
 * @property string $item
 * @property int $shipping_id
 *
 * @property Shipping $shipping
 */
class ShippingItem extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'shipping_item';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['item', 'shipping_id'], 'required'],
            [['shipping_id'], 'integer'],
            [['item'], 'string', 'max' => 50],
            [['shipping_id'], 'exist', 'skipOnError' => true, 'targetClass' => Shipping::className(), 'targetAttribute' => ['shipping_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'item' => 'Item',
            'shipping_id' => 'Shipping ID',
        ];
    }

    /**
     * Gets query for [[Shipping]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getShipping()
    {
        return $this->hasOne(Shipping::className(), ['id' => 'shipping_id'])->inverseOf('shippingItems');
    }
}
