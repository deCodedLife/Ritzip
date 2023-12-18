<?php

function format_phone_number( $number ) {

    $cleaned_number = preg_replace( '/\D/', '', $number );
    $formatted_number = "(" . substr( $cleaned_number, 0, 3).") ".substr( $cleaned_number, 3, 3 )."-".substr( $cleaned_number, 6 );
    return $formatted_number;

}

$drivers = [];

foreach ( $response[ "data" ] as $driver ) {

    $user = $API->DB->from( "users" )
        ->where( "id", $driver[ "responsible_id" ][ "value" ] )
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

    $driver[ "responsible_id" ][ "title" ] = $user[ "last_name" ] . " " . $user[ "first_name" ] .  $role[ "title" ] . $user[ "phone" ];

    $order = $API->DB->from( "orders" )
        ->where([
            "driver_id" => $driver["id"],
            "not status_id" => ["21", "22", "25", "26"]
        ])
        ->orderBy("created_at desc")
        ->limit(1)
        ->fetch();

    $orders = $API->DB->from( "orders" )
        ->where([
            "driver_id" => $driver["id"]
        ]);

    $driver[ "ordersCount" ] = count($orders);

    if ( $order[ "id" ] ) {

        $driver[ "order" ] = $order[ "id" ];
        $driver[ "orderStatus" ] = $order[ "status_id" ];

    } else {

        $driver[ "order" ] = "нет";

    }

    $task = $API->DB->from( "tasks" )
        ->where([
            "driver_id" => $driver["id"]
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

        $driver[ "task_id" ] = $task[ "title" ];
        $driver[ "taskStatus" ] = $custom_list[ $task[ "status" ] ];

    } else {

        $driver[ "task_id" ] = "Без задачи";
        $driver[ "taskStatus" ] = "Без задачи";

    }


    $drivers[] = $driver;

}

$response[ "data" ] = $drivers;


if ( $orderRq == "Y" ) {

    $drivers = [];

    foreach ( $response[ "data" ] as $key => $vehicle ) {

        if ( $vehicle[ "order" ] != "нет" ) {

            $drivers[] = $vehicle;

        }

    }

    $response[ "data" ] = $drivers;
    $response[ "data" ] = array_slice($response[ "data" ], $limit * $requestData->page - $limit, $limit);

} elseif ( $orderRq == "N" ) {

    $drivers = [];

    foreach ( $response[ "data" ] as $key => $vehicle ) {

        if ( $vehicle[ "order" ] == "нет" ) {

            $drivers[] = $vehicle;

        }

    }

    $response[ "data" ] = $drivers;
    $response[ "data" ] = array_slice($response[ "data" ], $limit * $requestData->page - $limit, $limit);

}

if ( $taskRq == "Y" ) {

    $drivers = [];

    foreach ( $response[ "data" ] as $key => $vehicle ) {

        if ( $vehicle[ "task_id" ] != "Без задачи" ) {

            $drivers[] = $vehicle;

        }

    }

    $response[ "data" ] = $drivers;
    $response[ "data" ] = array_slice($response[ "data" ], $limit * $requestData->page - $limit, $limit);

} elseif ( $taskRq == "N" ) {

    $drivers = [];

    foreach ( $response[ "data" ] as $key => $vehicle ) {

        if ( $vehicle[ "task_id" ] == "Без задачи" ) {

            $drivers[] = $vehicle;

        }

    }

    $response[ "data" ] = $drivers;
    $response[ "data" ] = array_slice($response[ "data" ], $limit * $requestData->page - $limit, $limit);

}


if ( $taskStatuses ) {

    $drivers = [];

    foreach ( $response[ "data" ] as $key => $driver ) {

        if ( in_array( $driver[ "taskStatus" ][ "value" ], $taskStatuses ) ) {

            $drivers[] = $driver;

        }

        $response[ "data" ] = $drivers;
        $response[ "data" ] = array_slice($response[ "data" ], $limit * $requestData->page - $limit, $limit);

    }

}


if ( $orderStatuses ) {

    $drivers = [];

    foreach ( $response[ "data" ] as $key => $driver ) {

        if ( in_array( $driver[ "orderStatus" ], $orderStatuses ) ) {

            $drivers[] = $driver;

        }

        $response[ "data" ] = $drivers;
        $response[ "data" ] = array_slice($response[ "data" ], $limit * $requestData->page - $limit, $limit);

    }

}

