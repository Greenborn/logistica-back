<?php

namespace app\controllers;

use Yii;
use yii\data\ActiveDataProvider;
use app\models\Shipping;

class DistanceController extends BaseController {

    public $modelClass = 'app\models\Distance';

    public function actions(){
      $actions = parent::actions();
      unset( $actions['delete'],
             $actions['update'],
             $actions['create']
           );

      return $actions;
    }

    public function actionIndex() {
      return new ActiveDataProvider([
        'query' => Distance::find(),
      ]);
    }
}
