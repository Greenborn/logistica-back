<?php

namespace app\modules\v1\models;

use Yii;

/**
 * This is the model class for table "service_type".
 *
 * @property int $id
 * @property string $description
 *
 * @property BranchOfficeHasServiceType[] $branchOfficeHasServiceTypes
 * @property Shipping[] $shippings
 */
class ServiceType extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'service_type';
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
     * Gets query for [[BranchOfficeHasServiceTypes]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getBranchOfficeHasServiceTypes()
    {
        return $this->hasMany(BranchOfficeHasServiceType::className(), ['service_type_id' => 'id'])->inverseOf('serviceType');
    }

    /**
     * Gets query for [[Shippings]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getShippings()
    {
        return $this->hasMany(Shipping::className(), ['service_type_id' => 'id'])->inverseOf('serviceType');
    }
}
