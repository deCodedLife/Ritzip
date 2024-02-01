<?php


if ( $requestData->context->block == "form_list" ) {

    $cars = [];

    foreach ( $response[ "data" ] as $car) {

        $carDetail = $API->DB->from( "cars" )
            ->where( "id", $car[ "title" ] )
            ->limit( 1 )
            ->fetch();

        if ( $carDetail[ "is_active" ] == "Y" )
            $cars[] = [
                "title" => $carDetail[ "brand" ] . " " . $carDetail[ "model" ] . ", " . $carDetail[ "yearRelease" ] . ", " .  $carDetail[ "vin" ],
                "value" => (string)$car[ "value" ]

            ];

    }

    $response[ "data" ] = $cars;

} else {

    $cars = [];

    foreach ( $response[ "data" ] as $car) {

        $carDetail = $API->DB->from( "cars" )
            ->where( "id", $car[ "car_id" ] )
            ->limit( 1 )
            ->fetch();

        if ( $carDetail[ "is_active" ] == "Y" )

            $car[ "id" ] = $carDetail[ "id" ];
            $car[ "brandModel" ] = $carDetail[ "brand" ] . " " . $carDetail[ "model" ];
            $car[ "yearRelease" ] = $carDetail[ "yearRelease" ];
            $cars[] = $car;

    }

    $response[ "data" ] = $cars;

}


