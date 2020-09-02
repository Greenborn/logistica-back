<?php

namespace app\controllers;

use Yii;
use yii\rest\ActiveController;
use yii\data\ActiveDataProvider;
use app\models\Shipping;
use yii\filters\auth\HttpBearerAuth;

class ShippingController extends ActiveController {

    public $modelClass = 'app\models\Shipping';

    public $serializer = [
        'class' => 'yii\rest\Serializer',
        'collectionEnvelope' => 'items',
    ];

    public function behaviors() {
        $behaviors = parent::behaviors();
        $behaviors['authenticator'] = [
            'class' => HttpBearerAuth::className(),
        ];
        return $behaviors;
    }


    public function actionIndex() {


    }

    public function actions(){
      $actions = parent::actions();
      $actions['create']['class'] = 'app\actions\CreateShippingAction';
      $actions['update']['class'] = 'app\actions\UpdateShippingAction';
      $actions['index']['prepareDataProvider'] = [$this, 'prepareDataProvider'];

      return $actions;
    }

    public function prepareDataProvider(){
      return new ActiveDataProvider([
        'query' => Shipping::find()->where(['origin_branch_office' => 2]),
      ]);
    }
}
