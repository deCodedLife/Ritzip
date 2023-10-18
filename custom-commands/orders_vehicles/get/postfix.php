<?php


$cars = [];

foreach ( $response[ "data" ] as $car) {

    $carDetail = $API->DB->from( "vehicles" )
        ->where( "id", $car[ "vehicle_id" ] )
        ->limit( 1 )
        ->fetch();

    if ( $carDetail[ "is_active" ] == "Y" )
        $car[ "id" ] = $carDetail[ "id" ];
        $cars[] = $car;

}

$response[ "data" ] = $cars;



