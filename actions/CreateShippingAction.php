<?php
namespace app\actions;

use Yii;
use yii\rest\CreateAction;
use yii\helpers\Url;

use app\models\ShippingItem;
use app\models\IdentificationType;
use app\models\Identification;
use app\models\User;
use app\components\HttpTokenAuth;
use app\util\Flags;

class CreateShippingAction extends CreateAction {

    private $pdfApiUrl = 'http://static-logistica.coodesoft.com.ar/index.php?r=remito/index';

    public function run() {
      $model = new $this->modelClass();
      $params = Yii::$app->getRequest()->getBodyParams();

      $user = User::findIdentityByAccessToken( HttpTokenAuth::getToken() );
      $params['origin_branch_office'] = $user->branchOffice->id;
      $params['status'] = Flags::SHIPPING_NEW;


      $anyErrors = false;
      $error = null;
      $response = Yii::$app->getResponse();

      try {
        $transaction = ShippingItem::getDb()->beginTransaction();

        $paramsIdentification = $params['sender_identification'];
        $createdIdentification = $this->storeIdentification($paramsIdentification);
        $model->sender_identification_id = $createdIdentification->id;

        $paramsIdentification = $params['receiver_identification'];
        $createdIdentification = $this->storeIdentification($paramsIdentification);
        $model->receiver_identification_id = $createdIdentification->id;

        $model->load($params, '');
        if ($model->save()) {

           if ( isset($params['items']) && !empty($params['items']) ) {

             foreach ( $params['items'] as $item ) {
               $newItem = new ShippingItem();
               $newItem->item = $item['description'];
               $newItem->shipping_id = $model->id;

               if ( !$newItem->save() ) {
                 $error = $newItem->getErrors();
                 $anyErrors = true;
                 break;
               }
             }

           } else{
             $error = [ 'error' => 'No se agregó ningun item!' ];
             $anyErrors = true;
           }

           if ($anyErrors){
             $transaction->rollBack();
             $response->setStatusCode(400);
             $response->format = \yii\web\Response::FORMAT_JSON;
             $response->data = $error;

           } else{
             $transaction->commit();
             $response->setStatusCode(201);
             $id = implode(',', array_values($model->getPrimaryKey(true)));
             $response->getHeaders()->set('Location', Url::toRoute([$this->viewAction, 'id' => $id], true));

             $remitoUrl = $this->pdfApiUrl . '&id='.$model->id.'&token='.$user->access_token;

             return [
               'shipping' => $model,
               '_links' => [
                 'remito' => [
                   'original' => $remitoUrl,
                   'remito_duplicado' => $remitoUrl .'&type=doubled',
                   'remito_triplicado' => $remitoUrl .'&type=tripled',
                   'remito_cuadruplicado' => $remitoUrl . '&type=cuadrupled',
                 ]
               ]
             ];
           }

        } elseif ($model->hasErrors()) {
          $response->setStatusCode(400);
          $response->format = \yii\web\Response::FORMAT_JSON;
          $response->data = $model->getErrors();
        } else {
          throw new ServerErrorHttpException('Failed to create the object for unknown reason.');
        }
      } catch (\Throwable $e) {
        $response->setStatusCode(500);
        $response->format = \yii\web\Response::FORMAT_JSON;
        $response->data = [ 'message' => $e->getMessage() ];
      }
    }

    protected function storeIdentification($identification){

      $idType = IdentificationType::findone($identification['type']);

      if (!$idType)
        throw new \Exception("El id del tipo de identificación es inválido", 1);

      $newModelId = new Identification();
      $newModelId->value = $identification['value'];
      $newModelId->identification_type = $idType->id;

      if ( !$newModelId->save() )
        throw new \Exception("No se pudo guardar la identificación ". json_encode($newModelId->errors), 1);

      return $newModelId;
    }
}
