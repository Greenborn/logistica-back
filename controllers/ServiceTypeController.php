<?php

namespace app\controllers;

use Yii;
use yii\rest\ActiveController;
use yii\data\ActiveDataProvider;
use app\models\ServiceType;

class ServiceTypeController extends ActiveController {

    public $modelClass = 'app\models\ServiceType';

    public function actionIndex() {
      return new ActiveDataProvider([
        'query' => ServiceType::find(),
      ]);
    }
}
