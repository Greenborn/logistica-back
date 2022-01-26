<?php
namespace app\modules\v1\controllers;

use yii\rest\ActiveController;
use yii\data\ActiveDataProvider;

use app\modules\v1\models\User;

class UserController extends ActiveController {

    public $modelClass = 'app\models\User';

    public $serializer = [
        'class' => 'yii\rest\Serializer',
        'collectionEnvelope' => 'items',
    ];

    public function actionIndex() {
      return new ActiveDataProvider([
        'query' => User::find(),
      ]);
    }

}
