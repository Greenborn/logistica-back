<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "branch_office".
 *
 * @property int $id
 * @property string $name
 *
 * @property BranchOfficeHasServiceType[] $branchOfficeHasServiceTypes
 * @property BranchOfficeHasShippingType[] $branchOfficeHasShippingTypes
 */
class BranchOffice extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'branch_office';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['name'], 'string', 'max' => 50],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
        ];
    }

    /**
     * Gets query for [[BranchOfficeHasServiceTypes]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getBranchOfficeHasServiceTypes()
    {
        return $this->hasMany(BranchOfficeHasServiceType::className(), ['branch_office_id' => 'id'])->inverseOf('branchOffice');
    }

    /**
     * Gets query for [[BranchOfficeHasShippingTypes]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getBranchOfficeHasShippingTypes()
    {
        return $this->hasMany(BranchOfficeHasShippingType::className(), ['branch_office_id' => 'id'])->inverseOf('branchOffice');
    }

    public function getUsers()
    {
        return $this->hasMany(User::className(), ['branch_office_id' => 'id'])->inverseOf('branchOffice');
    }
    /**
      * Gets query for [[Shippings]].
      *
      * @return \yii\db\ActiveQuery
     */
    public function getShippings()
    {
       return $this->hasMany(Shipping::className(), ['destination_branch_office' => 'id'])->inverseOf('destinationBranchOffice');
    }

   /**
     * Gets query for [[Shippings0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getShippings0()
    {
        return $this->hasMany(Shipping::className(), ['origin_branch_office' => 'id'])->inverseOf('originBranchOffice');
    }

    public function extraFields(){
      return [ 'incomingShipping' => function(){
                  return $this->shippings;
               },
               'outcomingShipping' => function(){
                  return $this->shippings0;
               },
               'user' ,
               'serviceType',
               'shippingType'];
    }

}
