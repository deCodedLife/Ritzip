<?php
/**
 * Получение информации о заказе перед удалением
 */
$previousValue = $API->DB->from( "orders" ) // get order info
->where( [
    "id" => $requestData->id
] )
->limit( 1 )
->fetch();

/**
 * Получение детальной информации о водителе
 */
$driverDetail = $API->DB->from( "users" )
    ->where( [
        "id" => $requestData->employee_id
    ] )
    ->limit( 1 )
    ->fetch();

/**
 * Получение детальной информации об автомобиле
 */
$carDetail = $API->DB->from( "cars" )
    ->where( [
        "id" => $requestData->car_id
    ] )
    ->limit( 1 )
    ->fetch();


/**
 * Обновление полей у водителя и авто
 */

$API->DB->update( "users" )
    ->set( [
     "sumOrder" => $driverDetail['sumOrder'] - $previousValue['cost'],
     "countOrder" => $driverDetail['countOrder'] - 1,
     "miles" => (float)$driverDetail['miles'] - (float)$previousValue['miles']
    ] )
    ->where( "id", $driverDetail['id'] )
    ->execute();

$API->DB->update( "cars" )
    ->set( [
     "sumOrder" => $carDetail['sumOrder'] - $previousValue['cost'],
     "countOrder" => $carDetail['countOrder'] - 1,
     "miles" => (float)$carDetail['miles'] - (float)$previousValue['miles']
    ] )
    ->where( "id", $carDetail['id'] )
    ->execute();
