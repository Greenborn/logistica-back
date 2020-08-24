<?php

namespace app\controllers;

use Yii;
use yii\rest\ActiveController;
use yii\data\ActiveDataProvider;
use app\models\Shipping;

class DistanceController extends ActiveController {

    public $modelClass = 'app\models\Distance';

    public function actionIndex() {
      return new ActiveDataProvider([
        'query' => Distance::find(),
      ]);
    }
}
