<?php

namespace app\controllers;

use Yii;
use yii\data\ActiveDataProvider;
use app\models\ShippingType;

class ShippingStatusController extends BaseController {

    public $modelClass = 'app\models\Status';

    public function actions(){
      $actions = parent::actions();
      unset( $actions['delete'],
             $actions['update'],
             $actions['create'],
             $actions['view'],
           );

      $actions['index']['class'] = 'app\actions\StatusIndexAction';

      return $actions;
    }

    public function actionIndex() {
      return new ActiveDataProvider([
        'query' => ShippingType::find(),
      ]);
    }
}
