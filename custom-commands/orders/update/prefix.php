<?php

/**
 * Сохранение истории изменения статуса заявки
 */

if ( $requestData->status_id ) {

    $orderDetail = $API->DB->from( "orders" )
        ->where( [
            "id" => $requestData->id
        ] )
        ->limit( 1 )
        ->fetch();

    $API->DB->insertInto( "ordersHistory" )
        ->values( [
            "order_id" => $requestData->id,
            "from_status_id" => $orderDetail[ "status_id" ],
            "to_status_id" => $requestData->status_id,
        ] )
        ->execute();

} // if. $requestData->status_id


if ( $requestData->miles ) {
   
    // start update miles in driver
    $previousValue = $API->DB->from( "orders" )
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

   $API->DB->update( "users" )
    ->set( [
        "miles" => (float)$driver['miles'] - (float)$previousValue['miles'] + (float)$requestData->miles
    ] )
    ->where( "id", $driver['id'] )
    ->execute();
    // end update miles in driver


    // start update miles in car
    $car = $API->DB->from( "cars" )
    ->where( [
        "id" => $previousValue['car_id']
    ] )
    ->limit( 1 )
    ->fetch();

   $API->DB->update( "cars" )
    ->set( [
        "miles" => (float)$car['miles'] - (float)$previousValue['miles'] + (float)$requestData->miles
    ] )
    ->where( "id", $car['id'] )
    ->execute();
    // end update miles in car

} // if. isset ( $requestData->miles ) && isset ( $requestData->employee_id )
