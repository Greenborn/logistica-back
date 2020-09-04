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

      $response = Yii::$app->getResponse();
      $response->format = \yii\web\Response::FORMAT_JSON;
      $status = false;

      if ($username && $password){
        $user = User::find()->where( ['username' => $username] )->one();
        $status = $user && Yii::$app->getSecurity()->validatePassword($password, $user->password_hash);
      }

    if ($status)
        $response->data = [
          'status' => $status,
          'token'  => $user->access_token,
        ];
    else
      $response->data = [
          'status' => $status,
          'message' => 'Unauthorize Access!',
      ];
  }
}
