<?php

namespace app\modules\v1\models;

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
}
