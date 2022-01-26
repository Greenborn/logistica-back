<?php

namespace app\controllers;

use Yii;
use yii\data\ActiveDataProvider;
use app\models\Shipping;

class IdentificationTypeController extends BaseController {

    public $modelClass = 'app\models\IdentificationType';

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
        'query' => IdentificationType::find(),
      ]);
    }
}
