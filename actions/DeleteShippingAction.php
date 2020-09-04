<?php
namespace app\actions;

use Yii;
use yii\rest\DeleteAction;

class DeleteShippingAction extends DeleteAction {

  public function run($id){
    $model = $this->findModel($id);

    if ($this->checkAccess) {
        call_user_func($this->checkAccess, $this->id, $model);
    }

    $response = Yii::$app->getResponse();
    try {
      $model->unlinkAll('shippingItems', true);
      if ($model->delete() === false) {
          throw new ServerErrorHttpException('Failed to delete the object for unknown reason.');
      }

      $response->setStatusCode(204);
    } catch (\throwable $e) {
      $response->setStatusCode(500);
      $response->data = ['message' => $e->getMessage() ];
    }
  }
}
