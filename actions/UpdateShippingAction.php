<?php
namespace app\actions;

use Yii;
use yii\rest\UpdateAction;
use yii\helpers\Url;

use app\models\ShippingItem;
use app\models\User;
use app\components\HttpTokenAuth;

class UpdateShippingAction extends UpdateAction {

    public function run($id) {
      $response = Yii::$app->getResponse();
      $model = $this->modelClass::find()->where(['id' => $id])->one();
      $params = Yii::$app->getRequest()->getBodyParams();

      $user = User::findIdentityByAccessToken( HttpTokenAuth::getToken() );
      $params['origin_branch_office'] = $user->branchOffice->id;

      $model->load($params, '');

      $anyErrors = false;
      $errorMsg = '';

      try {
        $transaction = ShippingItem::getDb()->beginTransaction();
        if ( $model->save() ){
          if ( isset($params['items']) && !empty($params['items']) ) {
            foreach ($params['items'] as $key => $item) {
              $storedItem = ShippingItem::find()->where(['id' => $item['id']])->one();
              if ( $storedItem != null ){

                $storedItem->item = $item['description'];
                if ( !$storedItem->save() ){
                  $anyErrors = true;
                  $errorMsg = $storedItem->getErrors();
                  break;
                }
              }
            }
          }

          if ($anyErrors){
            $transaction->rollBack();
            $response->statusCode(400);
            $response->format = \yii\web\Response::FORMAT_JSON;
            $response->data = [ 'status' => false, 'message' => $errorMsg ];
          } else{
            $transaction->commit();
            $response->setStatusCode(200);
            $response->data = [ 'status' => true ];
          }

        } elseif ( $model->hasErrors() ){
          $response->setStatusCode(400);
          $response->format = \yii\web\Response::FORMAT_JSON;
          $response->data = [ 'status' => false, 'message' => $model->getErrors() ];
        } else {
            throw new ServerErrorHttpException('Failed to create the object for unknown reason.');
        }

      } catch (\Throwable $e) {
        $response->setStatusCode(500);
        $response->format = \yii\web\Response::FORMAT_JSON;
        $response->data = [ 'message' => $e->getMessage() ];
      }
    }
}
