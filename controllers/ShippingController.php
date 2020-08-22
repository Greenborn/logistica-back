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
}
