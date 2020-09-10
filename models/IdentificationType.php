<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "identification_type".
 *
 * @property int $id
 * @property string $name
 *
 * @property Identification $identification
 */
class IdentificationType extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'identification_type';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['name'], 'string', 'max' => 20],
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
     * Gets query for [[Identification]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getIdentification()
    {
        return $this->hasOne(Identification::className(), ['identification_type' => 'id'])->inverseOf('identificationType');
    }
}
