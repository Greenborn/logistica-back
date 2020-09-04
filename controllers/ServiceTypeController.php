<?php

namespace app\controllers;

use Yii;
use yii\data\ActiveDataProvider;
use app\models\ServiceType;

class ServiceTypeController extends BaseController {

    public $modelClass = 'app\models\ServiceType';

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
        'query' => ServiceType::find(),
      ]);
    }
}
