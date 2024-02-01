<?php

if ( $requestData->context->block === "form_list" ) {

    $cars = [];

    foreach ( $response[ "data" ] as $car ) {

        $carDetail = $API->DB->from( "cars" )
            ->where( "id", $car[ "value" ] )
            ->limit( 1 )
            ->fetch();

        $car[ "title" ] = $carDetail[ "brand" ] . " " . $carDetail[ "model" ] . ", " . $carDetail[ "yearRelease" ] . ", " .  $carDetail[ "vin" ];

        $cars[] = $car;

    }

    $response[ "data" ] = $cars;

}

function format_phone_number( $number ) {

    $cleaned_number = preg_replace( '/\D/', '', $number );
    $formatted_number = "(" . substr( $cleaned_number, 0, 3).") ".substr( $cleaned_number, 3, 3 )."-".substr( $cleaned_number, 6 );
    return $formatted_number;

}

$returnCars = [];

foreach ( $response[ "data" ] as $car ) {

    $user = $API->DB->from( "users" )
        ->where( "id", $car[ "responsible_id" ][ "value" ] )
        ->limit( 1 )
        ->fetch();

    $role = $API->DB->from( "roles" )
        ->where( "id", $user[ "role_id" ] )
        ->limit( 1 )
        ->fetch();

    if ( $user[ "phone" ] ) {

        $user[ "phone" ] = ", " . format_phone_number( $user[ "phone" ] );

    }

    if ( $role ) {

        $role[ "title" ] = ", " . $role[ "title" ];

    }

    $car[ "responsible_id" ][ "title" ] = $user[ "last_name" ] . " " . $user[ "first_name" ] .  $role[ "title" ] . $user[ "phone" ];


    $driverCars = $API->DB->from( "driver_cars" )
        ->where([
            "car_id" => $car[ "id" ]
        ]);

    $driverCarsIds = [];

    foreach ( $driverCars as $driverCar ) {

        $driverCarsIds[] = $driverCar[ "id" ];

    }

    foreach ( $driverCarsIds as $driverCarsId  ) {

        $order = $API->DB->from( "orders" )
            ->where([
                "car_id" => $driverCarsId,
                "not status_id" => ["21", "22", "25", "26"]
            ])
            ->orderBy("created_at desc")
            ->limit(1)
            ->fetch();

        $orderStatus = $API->DB->from( "orderStatuses" )
            ->where( "id", $order[ "status_id" ] )
            ->limit(1)
            ->fetch();

        if ( $order[ "id" ] ) {

            $car[ "order" ][ "href" ] = "orders/update/" . $order[ "id" ];
            $car[ "order" ][ "title" ] = $order[ "id" ];

            $car[ "orderStatus" ] = [

                "value" => $order[ "status_id" ],
                "title" => $orderStatus[ "title" ]

            ];

        } else {

            $car[ "order" ][ "value" ] = "";
            $car[ "order" ][ "title" ] = "нет";

        }

    }

    $task = $API->DB->from( "tasks" )
        ->where([
            "car_id" => $car["id"]
        ])
        ->orderBy("created_at desc")
        ->limit(1)
        ->fetch();

    $custom_list = [
        "not_read" => [
            "value" => "not_read",
            "title" => "Не начата"
        ],
        "processing" => [
            "value" => "processing",
            "title" => "В процессе"
        ],
        "read" => [
            "value" => "read",
            "title" => "В ожидании ответа"
        ],
        "completed" => [
            "value" => "completed",
            "title" => "Завершена"
        ]
    ];

    if ( $task[ "id" ] ) {

        $car[ "task_id" ][ "href" ] = "tasks/update/" . $task[ "id" ];
        $car[ "task_id" ][ "title" ] = $task[ "id" ];
        $car[ "taskStatus" ] = $custom_list[ $task[ "status" ] ];

    } else {

        $car[ "task_id" ][ "value" ] = "";
        $car[ "task_id" ][ "title" ] = "Без задачи";

    }

    $car[ "brandModel" ] = $car[ "brand" ] . " " . $car[ "model" ];
    $car[ "miles" ] = number_format($car[ "miles" ], 0, '', ' ');
    $car[ "milesAll" ] = number_format($car[ "milesAll" ], 0, '', ' ');

    $returnCars[] = $car;

} // foreach. $response[ "data" ]

$response[ "data" ] = $returnCars;


if ( $orderRq == "Y" ) {

    $cars = [];

    foreach ( $response[ "data" ] as $key => $car ) {

        if ( $car[ "order" ] != "нет" ) {

            $cars[] = $car;

        }

    }

    $response[ "data" ] = $cars;
    $response[ "data" ] = array_slice($response[ "data" ], $limit * $requestData->page - $limit, $limit);

} elseif ( $orderRq == "N" ) {

    $cars = [];

    foreach ( $response[ "data" ] as $key => $car ) {

        if ( $car[ "order" ] == "нет" ) {

            $cars[] = $car;

        }

    }

    $response[ "data" ] = $cars;
    $response[ "data" ] = array_slice($response[ "data" ], $limit * $requestData->page - $limit, $limit);

}

if ( $trailerRq == "Y" ) {

    $cars = [];

    foreach ( $response[ "data" ] as $key => $car ) {

        if ( $car[ "trailer" ] ) {

            $cars[] = $car;

        }

    }

    $response[ "data" ] = $cars;
    $response[ "data" ] = array_slice($response[ "data" ], $limit * $requestData->page - $limit, $limit);

} elseif ( $trailerRq == "N" ) {

    $cars = [];

    foreach ( $response[ "data" ] as $key => $car ) {

        if ( !$car[ "trailer" ] ) {

            $cars[] = $car;

        }

    }

    $response[ "data" ] = $cars;
    $response[ "data" ] = array_slice($response[ "data" ], $limit * $requestData->page - $limit, $limit);

}


if ( $taskRq == "Y" ) {

    $cars = [];

    foreach ( $response[ "data" ] as $key => $car ) {

        if ( $car[ "task_id" ] != "Без задачи" ) {

            $cars[] = $car;

        }

    }

    $response[ "data" ] = $cars;
    $response[ "data" ] = array_slice($response[ "data" ], $limit * $requestData->page - $limit, $limit);

} elseif ( $taskRq == "N" ) {

    $cars = [];

    foreach ( $response[ "data" ] as $key => $car ) {

        if ( $car[ "task_id" ] == "Без задачи" ) {

            $cars[] = $car;

        }

    }

    $response[ "data" ] = $cars;
    $response[ "data" ] = array_slice($response[ "data" ], $limit * $requestData->page - $limit, $limit);

}


if ( $taskStatuses ) {

    $cars = [];

    foreach ( $response[ "data" ] as $key => $driver ) {

        if ( in_array( $driver[ "taskStatus" ][ "value" ], $taskStatuses ) ) {

            $cars[] = $driver;

        }

        $response[ "data" ] = $cars;
        $response[ "data" ] = array_slice($response[ "data" ], $limit * $requestData->page - $limit, $limit);

    }

}


if ( $orderStatuses ) {

    $cars = [];

    foreach ( $response[ "data" ] as $key => $driver ) {

        if ( in_array( $driver[ "orderStatus" ], $orderStatuses ) ) {

            $cars[] = $driver;

        }

        $response[ "data" ] = $cars;
        $response[ "data" ] = array_slice($response[ "data" ], $limit * $requestData->page - $limit, $limit);

    }

}
