<?php

namespace app\controllers;

use Yii;

use app\models\Shipping;
use app\models\User;
use app\controllers\BaseController;
use app\components\HttpTokenAuth;

use yii\data\ActiveDataProvider;
use yii\filters\auth\HttpBearerAuth;

class ShippingController extends BaseController {

    public $modelClass = 'app\models\Shipping';

    public $serializer = [
        'class' => 'yii\rest\Serializer',
        'collectionEnvelope' => 'items',
    ];

    public function actions(){
      $actions = parent::actions();
      $actions['create']['class'] = 'app\actions\CreateShippingAction';
      $actions['update']['class'] = 'app\actions\UpdateShippingAction';
      $actions['delete']['class'] = 'app\actions\DeleteShippingAction';
      $actions['index']['prepareDataProvider'] = [$this, 'prepareDataProvider'];

      return $actions;
    }

    public function prepareDataProvider(){
      $token = $this->getAccessToken();
      $user = User::findIdentityByAccessToken($token);

      return new ActiveDataProvider([
        'query' => Shipping::find()
                   ->where(['origin_branch_office' => $user->branchOffice->id])
                   ->orWhere(['destination_branch_office' => $user->branchOffice->id]),
      ]);
    }

    public function checkAccess($action, $model = null, $params = []) {
      $user = User::findIdentityByAccessToken( HttpTokenAuth::getToken() );

      if ($action === 'update' || $action === 'delete') {
        if ( $user->branchOffice->id != $model->originBranchOffice->id ){
            throw new \yii\web\ForbiddenHttpException('El usuario solo puede crear/actualizar envíos cuya sucursal de origen sea igual a su sucursal');
        }
      }

      if ($action == 'view'){
        if ( $user->branchOffice->id != $model->originBranchOffice->id  && $user->branchOffice->id != $model->destinationBranchOffice->id){
            throw new \yii\web\ForbiddenHttpException('El usuario solo puede ver envíos cuya sucursal de origen/destino sea igual a su sucursal');
        }

      }
    }
}
