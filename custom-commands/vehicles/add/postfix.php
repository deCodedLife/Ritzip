<?php

if ( $requestData->id ) {

    $vehicle = $API->DB->from( "vehicles" )
        ->where( "vin", $requestData->vin )
        ->limit( 1 )
        ->fetch();

    $API->DB->insertInto( "orders_vehicles" )
        ->values( [
            "order_id" => $requestData->id,
            "vehicle_id" => $vehicle[ "id" ]
        ] )
        ->execute();

}

