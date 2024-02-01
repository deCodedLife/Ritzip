<?php

$returnCompanies = [];

foreach ( $response[ "data" ] as $company ) {

    $order = $API->DB->from( "orders" )
        ->where([
            "company_id" => $company["id"],
            "not status_id" => ["21", "22", "25", "26"]
        ])
        ->orderBy("created_at desc")
        ->limit(1)
        ->fetch();


    $orders = $API->DB->from( "orders" )
        ->where([
            "company_id" => $company["id"]
        ]);

    $company[ "ordersCount" ] = count($orders);

    $orderStatus = $API->DB->from( "orderStatuses" )
        ->where( "id", $order[ "status_id" ] )
        ->limit(1)
        ->fetch();

    if ( $order[ "id" ] ) {

        $company[ "order" ][ "href" ] = "orders/update/" . $order[ "id" ];
        $company[ "order" ][ "title" ] = $order[ "id" ];

        $company[ "orderStatus" ] = [

            "value" => $order[ "status_id" ],
            "title" => $orderStatus[ "title" ]

        ];

    } else {

        $company[ "order" ][ "value" ] = "";
        $company[ "order" ][ "title" ] = "нет";

    }

    $task = $API->DB->from( "tasks" )
        ->where([
            "company_id" => $company["id"]
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

        $company[ "task_id" ][ "href" ] = "tasks/update/" . $task[ "id" ];
        $company[ "task_id" ][ "title" ] = $task[ "id" ];
        $company[ "taskStatus" ] = $custom_list[ $task[ "status" ] ];

    } else {

        $company[ "task_id" ][ "value" ] = "";
        $company[ "task_id" ][ "title" ] = "Без задачи";

    }


    $returnCompanies[] = $company;

}

$response[ "data" ] = $returnCompanies;


if ( $orderRq == "Y" ) {

    $returnCompanies = [];

    foreach ( $response[ "data" ] as $key => $company ) {

        if ( $company[ "order" ] != "нет" ) {

            $returnCompanies[] = $company;

        }

    }

    $response[ "data" ] = $returnCompanies;
    $response[ "data" ] = array_slice($response[ "data" ], $limit * $requestData->page - $limit, $limit);

} elseif ( $orderRq == "N" ) {

    $returnCompanies = [];

    foreach ( $response[ "data" ] as $key => $company ) {

        if ( $company[ "order" ] == "нет" ) {

            $returnCompanies[] = $company;

        }

    }

    $response[ "data" ] = $returnCompanies;
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

        if ( in_array( $driver[ "orderStatus" ][ "value" ], $orderStatuses ) ) {

            $drivers[] = $driver;

        }

        $response[ "data" ] = $drivers;
        $response[ "data" ] = array_slice($response[ "data" ], $limit * $requestData->page - $limit, $limit);

    }

}

if ( $orders_count_from ) {

    $filteredOrders = [];

    foreach ( $response[ "data" ] as $company ) {

        if ( $orders_count_from <= $company[ "ordersCount" ] ) {

            $filteredOrders[] = $company;

        }

    }

    /**
     * Запись в выдачу
     */
    $response[ "data" ] = $filteredOrders;

}

if ( $orders_count_to ) {

    $filteredOrders = [];

    foreach ( $response[ "data" ] as $company ) {

        if ( $orders_count_to >= $company[ "ordersCount" ] ) {

            $filteredOrders[] = $company;

        }

    }

    /**
     * Запись в выдачу
     */
    $response[ "data" ] = $filteredOrders;

}

//
//if ( $orders_cost_from ) {
//
//    $filteredOrders = [];
//
//    foreach ( $response[ "data" ] as $company ) {
//
//        $orders = $API->DB->from( "orders" )
//            ->where( "company_id", $company[ "id" ] );
//
//        $cost = 0;
//
//        foreach ( $orders as $order ) {
//
//            $cost += $order[ "cost" ];
//
//        }
//
//        if ( $orders_cost_from <= $cost ) {
//
//            $filteredOrders[] = $company;
//
//        }
//
//    }
//
//    /**
//     * Запись в выдачу
//     */
//    $response[ "data" ] = $filteredOrders;
//
//}
//
//if ( $orders_cost_to ) {
//
//    $filteredOrders = [];
//
//    foreach ( $response[ "data" ] as $company ) {
//
//        $orders = $API->DB->from( "orders" )
//            ->where( "company_id", $company[ "id" ] );
//
//        $cost = 0;
//
//        foreach ( $orders as $order ) {
//
//            $cost += $order[ "cost" ];
//
//        }
//
//        if ( $orders_cost_to >= $cost ) {
//
//            $filteredOrders[] = $company;
//
//        }
//
//    }
//
//    /**
//     * Запись в выдачу
//     */
//    $response[ "data" ] = $filteredOrders;
//
//
//}