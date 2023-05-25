<?php

/**
 * Изменение колличество поеханых миль при измменения заявок
 */
if ( $requestData->miles && $requestData->employee_id ) {
    
    // start update miles in driver
    $driverPreviousValue = $API->DB->from( "users" )
    ->where( [
        "id" => $requestData->employee_id
    ] )
    ->limit( 1 )
    ->fetch();
  
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

