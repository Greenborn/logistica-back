<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "identification".
 *
 * @property int $id
 * @property string $value
 * @property int $identification_type
 *
 * @property IdentificationType $identificationType
 * @property Shipping[] $shippings
 * @property Shipping[] $shippings0
 */
class Identification extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'identification';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['value', 'identification_type'], 'required'],
            [['identification_type'], 'integer'],
            [['value'], 'string', 'max' => 15],
            [['identification_type'], 'exist', 'skipOnError' => true, 'targetClass' => IdentificationType::className(), 'targetAttribute' => ['identification_type' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'value' => 'Value',
            'identification_type' => 'Identification Type',
        ];
    }

    /**
     * Gets query for [[IdentificationType]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getIdentificationType()
    {
        return $this->hasOne(IdentificationType::className(), ['id' => 'identification_type'])->inverseOf('identification');
    }

    /**
     * Gets query for [[Shippings]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getShippings()
    {
        return $this->hasMany(Shipping::className(), ['sender_identification_id' => 'id'])->inverseOf('senderIdentification');
    }

    /**
     * Gets query for [[Shippings0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getShippings0()
    {
        return $this->hasMany(Shipping::className(), ['sender_identification_id' => 'id'])->inverseOf('receiverIdentification');
    }

    public function fields() {
        $fields = parent::fields();

        unset( $fields['identification_type'] );

        $fields['identification_type'] = function(){
          return $this->identificationType;
        };


        return $fields;
    }
}
