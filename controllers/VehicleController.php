<?php
namespace app\controllers;

use yii\rest\ActiveController;
use yii\data\ActiveDataProvider;

use app\modules\v1\models\User;

class VehicleController extends BaseController {

    public $modelClass = 'app\models\Vehicle';

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
        'query' => Vehicle::find(),
      ]);
    }
}
