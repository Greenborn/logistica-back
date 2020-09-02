<?php

namespace app\controllers;

use yii\rest\ActiveController;

class LoginController extends ActiveController {

    public $modelClass = '';

    public function actions(){
      $actions = parent::actions();
      unset( $actions['delete'],
             $actions['update'],
             $actions['index'],
             $actions['view']
           );

      $actions['create']['class'] = 'app\actions\LoginAction';
      return $actions;

        }
}
