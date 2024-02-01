<?php

if ( $requestData->context->block === "form_list" ) {

    $vehicles = [];

    foreach ( $response[ "data" ] as $vehicle ) {

        $vehicleDetail = $API->DB->from( "vehicles" )
            ->where( "id", $vehicle[ "value" ] )
            ->limit( 1 )
            ->fetch();

        if ( $vehicleDetail[ "is_in_orders" ] == "Y" ) continue;

        $vehicle[ "title" ] = $vehicleDetail[ "brand" ] . " " . $vehicleDetail[ "model" ] . ", " . $vehicleDetail[ "year" ] . ", " .  $vehicleDetail[ "vin" ];

        $vehicles[] = $vehicle;

    }

    $response[ "data" ] = $vehicles;

}

if ( $requestData->context->block == "list" ) {

    $vehicles = [];

    foreach ( $response[ "data" ] as $vehicle ) {

        $vehicle[ "brandModel" ] = $vehicle[ "brand" ] . " " . $vehicle[ "model" ];

        $order = $API->DB->from("orders")
            ->leftJoin("orders_vehicles ON orders_vehicles.order_id = orders.id")
            ->select(null)
            ->select(["orders.id", "orders.status_id", "orders_vehicles.vehicle_id"])
            ->where([
                "orders_vehicles.vehicle_id" => $vehicle["id"],
                "not orders.status_id" => ["21", "22", "25", "26"]
            ])
            ->orderBy("orders.created_at desc")
            ->limit(1)
            ->fetch();

        $orderStatus = $API->DB->from( "orderStatuses" )
            ->where( "id", $order[ "status_id" ] )
            ->limit(1)
            ->fetch();

        if ( $order[ "id" ] ) {

            $vehicle[ "order" ][ "href" ] = "orders/update/" . $order[ "id" ];
            $vehicle[ "order" ][ "title" ] = $order[ "id" ];
            $vehicle[ "orderStatus" ] = [

                "value" => $order[ "status_id" ],
                "title" => $orderStatus[ "title" ]

            ];

        } else {

            $vehicle[ "order" ][ "value" ] = "";
            $vehicle[ "order" ][ "title" ] = "нет";

        }

        $vehicles[] = $vehicle;


    }

    $response[ "data" ] = $vehicles;

    if ( $orderRq == "Y" ) {

        $vehicles = [];

        foreach ( $response[ "data" ] as $key => $vehicle ) {

            if ( $vehicle[ "order" ] != "нет" ) {

                $vehicles[] = $vehicle;

            }

        }

        $response[ "data" ] = $vehicles;
        $response[ "data" ] = array_slice($response[ "data" ], $limit * $requestData->page - $limit, $limit);

    } elseif ( $orderRq == "N" ) {

        $vehicles = [];

        foreach ( $response[ "data" ] as $key => $vehicle ) {

            if ( $vehicle[ "order" ] == "нет" ) {

                $vehicles[] = $vehicle;

            }

        }

        $response[ "data" ] = $vehicles;
        $response[ "data" ] = array_slice($response[ "data" ], $limit * $requestData->page - $limit, $limit);

    }

    if ( $statuses ) {

        $vehicles = [];


        foreach ( $response[ "data" ] as $key => $vehicle ) {

            if ( in_array( $vehicle[ "orderStatusID" ], $statuses ) ) {

                $vehicles[] = $vehicle;

            }

            $response[ "data" ] = $vehicles;
            $response[ "data" ] = array_slice($response[ "data" ], $limit * $requestData->page - $limit, $limit);

        }

    }



}




