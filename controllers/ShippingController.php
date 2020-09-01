<?php

namespace app\controllers;

use Yii;
use yii\rest\ActiveController;
use yii\data\ActiveDataProvider;
use app\models\Shipping;

class ShippingController extends ActiveController {

    public $modelClass = 'app\models\Shipping';

    public function actionIndex() {
      return new ActiveDataProvider([
        'query' => Shipping::find(),
      ]);
    }

    public function actions(){
      $actions = parent::actions();
      $actions['create']['class'] = 'app\actions\CreateShippingAction';
      $actions['update']['class'] = 'app\actions\UpdateShippingAction';
      return $actions;

    }
}
