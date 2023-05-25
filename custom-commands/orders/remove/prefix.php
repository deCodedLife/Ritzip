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

// start update miles in driver

$driver = $API->DB->from( "users" )
->where( [
    "id" => $previousValue['employee_id']
] )
->limit( 1 )
->fetch();

$API->DB->update( "users" )
->set( [
    "miles" => (float)$driver['miles'] - (float)$previousValue['miles']
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
    "miles" => (float)$car['miles'] - (float)$previousValue['miles']
] )
->where( "id", $car['id'] )
->execute();
// end update miles in car



