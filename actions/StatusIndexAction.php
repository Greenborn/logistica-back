<?php
namespace app\actions;

use Yii;
use yii\rest\IndexAction;
use yii\helpers\Url;
use app\models\ShippingItem;
use app\models\User;

class StatusIndexAction extends IndexAction {

  public function run() {
    $response = Yii::$app->getResponse();
    $response->format = \yii\web\Response::FORMAT_JSON;
    $response->data = [
      $this->modelClass::SHIPPING_NEW       => 'Nuevo',
      $this->modelClass::SHIPPING_TRAVELING => 'En camino',
      $this->modelClass::SHIPPING_ARRIVED   => 'Llegó a Sucursal',
      $this->modelClass::SHIPPING_DELIVERED => 'Entregado',
    ];
  }
}
