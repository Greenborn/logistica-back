<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "distance".
 *
 * @property int $id
 * @property string $description
 *
 * @property Shipping[] $shippings
 */
class Distance extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'distance';
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
     * Gets query for [[Shippings]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getShippings()
    {
        return $this->hasMany(Shipping::className(), ['distance_id' => 'id'])->inverseOf('distance');
    }
}
