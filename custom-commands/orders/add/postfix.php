<?php

$driverPreviousValue = $API->DB->from( "users" )
->where( [
    "id" => $requestData->employee_id
] )
->limit( 1 )
->fetch();

/**
 * Изменение колличество проеханых миль при измменения заявок
 */
if ( $requestData->miles && $requestData->employee_id ) {
    
    // start update miles in driver
  
    $API->DB->update( "users" )
    ->set( [
        "miles" => $requestData->miles + $driverPreviousValue['miles']
    ] )
    ->where( "id", $requestData->employee_id )
    ->execute();
    // end update miles in driver

    // start update miles in car
    $carPreviousValue = $API->DB->from( "cars" )
    ->where( [
        "id" => $requestData->car_id
    ] )
    ->limit( 1 )
    ->fetch();
  

    $API->DB->update( "cars" )
    ->set( [
        "miles" => $requestData->miles + $carPreviousValue['miles']
    ] )
    ->where( "id", $requestData->car_id )
    ->execute();
    // end update miles in car

} // if. isset ( $requestData->miles ) && isset ( $requestData->employee_id )


/**
 * Заполнение поля "Нужно оплатить"
 */
$API->DB->update( "orders" )
->set( [
    "needPay" => $requestData->cost
] )
->where( "id", $requestData->id )
->execute();


/**
 * Изменение полей выбранных водителя и авто "Кол-во заказов" и сумма заказов
 */

if ( $requestData->cost ){
    $API->DB->update( "users" )
    ->set( [
        "sumOrder" => $driverPreviousValue['sumOrder'] + $requestData->cost,
        "countOrder" => $driverPreviousValue['countOrder'] + 1
    ] )
    ->where( "id", $requestData->employee_id )
    ->execute();
    
    $API->DB->update( "cars" )
    ->set( [
        "sumOrder" => $driverPreviousValue['sumOrder'] + $requestData->cost,
        "countOrder" => $driverPreviousValue['countOrder'] + 1
    ] )
    ->where( "id", $requestData->car_id )
    ->execute();
} else {
    $API->DB->update( "cars" )
    ->set( [
    "countOrder" => $driverPreviousValue['countOrder'] + 1
    ] )
    ->where( "id", $requestData->car_id )
    ->execute();
}
