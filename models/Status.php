<?php
namespace app\models;

use yii\base\Model;
use app\util\Flags;

class Status extends Model {

  public static $status = [
    Flags::SHIPPING_NEW => 'Nuevo',
    Flags::SHIPPING_TRAVELING => 'En camino',
    Flags::SHIPPING_ARRIVED => 'Llegó a sucursal',
    Flags::SHIPPING_DELIVERED => 'Entregado',
  ];

  public static function toAssoc(){
    $toAssoc = [];
    foreach (static::$status as $key => $value) {
      $toAssoc[] = ['id' => $key, 'label' => $value];
    }
    return $toAssoc;
  }

  public static function getExtended($id){
    $label = static::$status[$id];
    return [ 'id' => $id, 'label' => $label];

  }



}


 ?>
