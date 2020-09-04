<?php

namespace app\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\behaviors\BlameableBehavior;
/**
 * This is the model class for table "user".
 *
 * @property int $id
 * @property string|null $username
 * @property string|null $password_hash
 * @property string|null $password_reset_token
 * @property string|null $auth_key
 * @property int|null $status
 * @property string|null $created_at
 * @property string|null $updated_at
 * @property int $role_id
 * @property int|null $access_id
 * @property int $branch_office_id
 *
 * @property Role $role
 * @property BranchOffice $branchOffice
 * @property Access $access
 */
class User extends \yii\db\ActiveRecord implements \yii\web\IdentityInterface
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'user';
    }

    public function behavior(){
      return [
        TimestampBehavior::class,
        [
          'class' => BlameableBehavior::class,
          'updatedByAttribute' => false,
        ]
      ];
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['status', 'role_id', 'access_id', 'branch_office_id'], 'integer'],
            [['role_id', 'branch_office_id'], 'required'],
            [['access_token'], 'string', 'max' => 128],
            [['username', 'created_at', 'updated_at'], 'string', 'max' => 45],
            [['password_hash', 'password_reset_token'], 'string', 'max' => 255],
            [['role_id'], 'exist', 'skipOnError' => true, 'targetClass' => Role::className(), 'targetAttribute' => ['role_id' => 'id']],
            [['branch_office_id'], 'exist', 'skipOnError' => true, 'targetClass' => BranchOffice::className(), 'targetAttribute' => ['branch_office_id' => 'id']],
            [['access_id'], 'exist', 'skipOnError' => true, 'targetClass' => Access::className(), 'targetAttribute' => ['access_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'username' => 'Username',
            'password_hash' => 'Password Hash',
            'password_reset_token' => 'Password Reset Token',
            'access_token' => 'Access Token',
            'status' => 'Status',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'role_id' => 'Role ID',
            'access_id' => 'Access ID',
            'branch_office_id' => 'Branch Office ID',
        ];
    }

    /**
     * Gets query for [[Role]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getRole()
    {
        return $this->hasOne(Role::className(), ['id' => 'role_id'])->inverseOf('users');
    }

    /**
     * Gets query for [[BranchOffice]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getBranchOffice()
    {
        return $this->hasOne(BranchOffice::className(), ['id' => 'branch_office_id'])->inverseOf('users');
    }

    /**
     * Gets query for [[Access]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getAccess()
    {
        return $this->hasOne(Access::className(), ['id' => 'access_id'])->inverseOf('users');
    }

    public function fields()
    {
        $fields = parent::fields();

        // quita los campos con información sensible
        unset( //$fields['password_hash'],
               $fields['password_reset_token'],
               $fields['role_id'],
               $fields['branch_office_id']
             );

        return $fields;
    }

    public function extraFields()
    {
        return ['branchOffice', 'role'];
    }

    public static function findIdentity($id)
    {
        return isset(self::$users[$id]) ? new static(self::$users[$id]) : null;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getAuthKey() {}

    public function validateAuthKey($authKey) {}

    public static function findIdentityByAccessToken($token, $type = null){
      return static::find()->where(['access_token' => $token])->with('branchOffice')->one();
    }
}
