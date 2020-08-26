<?php

namespace app\controllers;

use Yii;
use yii\rest\ActiveController;
use yii\data\ActiveDataProvider;
use app\models\BranchOffice;

class BranchOfficeController extends ActiveController {

    public $modelClass = 'app\models\BranchOffice';

    public function actionIndex() {
      return new ActiveDataProvider([
        'query' => Shipping::find(),
      ]);
    }
}
