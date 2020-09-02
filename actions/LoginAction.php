<?php
namespace app\actions;

use Yii;
use yii\rest\CreateAction;
use yii\helpers\Url;
use app\models\ShippingItem;
use app\models\User;

class LoginAction extends CreateAction {

    public function run() {
      $params = Yii::$app->getRequest()->getBodyParams();
      $username = isset($params['username']) ? $params['username'] : null;
      $password = isset($params['password']) ? $params['password'] : null;

      if ($username && $password){
        $user = User::find()->where( ['username' => $username] )->one();
        if ($user){
        //  return Yii::$app->getSecurity()->generatePasswordHash($password);
        //  return Yii::$app->getSecurity()->validatePassword($password, $user->password_hash);
          if (Yii::$app->getSecurity()->validatePassword($password, $user->password_hash)) {
            return $user->access_token;
        }
      }
      return false;
    }
  }
}
