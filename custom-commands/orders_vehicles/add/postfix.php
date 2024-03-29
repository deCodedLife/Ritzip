<?php

/**
 * Подсчет свободных мест
 */
$orderDetail = $API->DB->from( "orders" )
    ->where( "id", $requestData->order_id )
    ->limit( 1 )
    ->fetch();

$vehicles = $API->DB->from( "orders_vehicles" )
    ->where( "order_id", $requestData->order_id )
    ->limit( 20 );


$API->DB->update( "orders" )
    ->set( [
        "placeOccupied" => count( $vehicles ),
        "placeFree" => (int) $orderDetail['placeCount'] - count( $vehicles )
    ] )
    ->where( "id", $requestData->order_id )
    ->execute();


$vehicleDetail = $API->DB->from( "vehicles" )
    ->where( "id", $requestData->vehicle_id )
    ->limit( 1 )
    ->fetch();

$API->addLog( [
    "table_name" => "orders",
    "description" => "Добавлено ТС на отправку: " . $vehicleDetail[ "brand" ] . " " . $vehicleDetail[ "model" ] . ", " . $vehicleDetail[ "yearRelease" ] . ", " .  $vehicleDetail[ "vin" ],
    "row_id" => $requestData->order_id
], $requestData );
