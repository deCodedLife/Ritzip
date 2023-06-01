<?php

/**
 * Изменение колличество поеханых миль при измменения заявок
 */

$previousValue = $API->DB->from( "orders" ) // get order info
->where( [
    "id" => $requestData->id
] )
->limit( 1 )
->fetch();

$driver = $API->DB->from( "users" )
->where( [
    "id" => $previousValue['employee_id']
] )
->limit( 1 )
->fetch();

$car = $API->DB->from( "cars" )
->where( [
    "id" => $previousValue['car_id']
] )
->limit( 1 )
->fetch();




/**
 * Изменение поей выбраных водителя и авто "Мили", "Кол-во заказов" и "Сумма заказов" 
 */

 $API->DB->update( "users" )
 ->set( [
     "sumOrder" => $driver['sumOrder'] - $previousValue['cost'],
     "countOrder" => $driver['countOrder'] - 1,
     "miles" => (float)$driver['miles'] - (float)$previousValue['miles']
 ] )
 ->where( "id", $driver['id'] )
 ->execute();

 $API->DB->update( "cars" )
 ->set( [
     "sumOrder" => $car['sumOrder'] - $previousValue['cost'],
     "countOrder" => $car['countOrder'] - 1,
     "miles" => (float)$car['miles'] - (float)$previousValue['miles']
 ] )
 ->where( "id", $car['id'] )
 ->execute();
