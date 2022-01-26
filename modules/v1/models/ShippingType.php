<?php

namespace app\modules\v1\models;

use Yii;

/**
 * This is the model class for table "shipping_type".
 *
 * @property int $id
 * @property string $description
 *
 * @property BranchOfficeHasShippingType[] $branchOfficeHasShippingTypes
 * @property Shipping[] $shippings
 */
class ShippingType extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'shipping_type';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['description'], 'required'],
            [['description'], 'string', 'max' => 50],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'description' => 'Description',
        ];
    }

    /**
     * Gets query for [[BranchOfficeHasShippingTypes]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getBranchOfficeHasShippingTypes()
    {
        return $this->hasMany(BranchOfficeHasShippingType::className(), ['shipping_type_id' => 'id'])->inverseOf('shippingType');
    }

    /**
     * Gets query for [[Shippings]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getShippings()
    {
        return $this->hasMany(Shipping::className(), ['shipping_type_id' => 'id'])->inverseOf('shippingType');
    }
}
