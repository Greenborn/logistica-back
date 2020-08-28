<?php

namespace app\controllers;

use Yii;
use yii\rest\ActiveController;
use yii\data\ActiveDataProvider;
use app\models\ShippingType;

class ShippingTypeController extends ActiveController {

    public $modelClass = 'app\models\ShippingType';

    public function actionIndex() {
      return new ActiveDataProvider([
        'query' => Distance::find(),
      ]);
    }
}
