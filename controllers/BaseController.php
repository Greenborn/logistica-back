<?php

namespace app\controllers;

use yii\rest\ActiveController;
use yii\data\ActiveDataProvider;
use yii\filters\Cors;

use app\components\HttpTokenAuth;
use app\models\Shipping;

class BaseController extends ActiveController {

    public $serializer = [
        'class' => 'yii\rest\Serializer',
        'collectionEnvelope' => 'items',
    ];

    public function behaviors() {
        $behaviors = parent::behaviors();
        $behaviors['authenticator'] = [
            'class' => HttpTokenAuth::className(),
             'except' => ['options'],
        ];
        $behaviors['corsFilter'] = [
           'class' => Cors::className(),
           'cors' => [
                 'Origin' => ['*'],
                 'Access-Control-Request-Method' => ['GET', 'POST', 'PUT', 'PATCH', 'DELETE', 'HEAD', 'OPTIONS'],
                 'Access-Control-Request-Headers' => ['*'],
                 'Access-Control-Allow-Credentials' => null,
                 'Access-Control-Allow-Origin' => ['*'],
                 'Access-Control-Max-Age' => 0,
                 'Access-Control-Expose-Headers' => [],
             ]
        ];
        return $behaviors;
    }

    protected function getAccessToken(){
      return HttpTokenAuth::getToken();
    }

}
