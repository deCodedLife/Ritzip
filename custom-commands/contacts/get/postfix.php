<?php

if ( $requestData->context->block == "list" ) {

    $filteredContacts = [];

    foreach ( $response[ "data" ] as $contact ) {

        $companies = [];

        foreach ( $contact[ "company_id" ] as $company ) {

            $company[ "href" ] = "companies/update/" . $company[ "value" ];
            $companies[] = $company;

        }

        $contact[ "company_id" ] = $companies;

        $contact[ "fi" ] = $contact[ "last_name" ] . " " . $contact[ "first_name" ];

        $task = $API->DB->from( "tasks" )
            ->where([
                "contact_id" => $contact[ "id" ],
                "is_active" => "Y"
            ])
            ->orderBy( "created_at desc" )
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

            $contact[ "task_id" ][ "href" ] = "tasks/update/" . $task[ "id" ];
            $contact[ "task_id" ][ "title" ] = $task[ "id" ];
            $contact[ "taskStatus" ] = $custom_list[ $task[ "status" ] ];

        } else {

            $contact[ "task_id" ][ "value" ] = "";
            $contact[ "task_id" ][ "title" ] = "Без задачи";

        }

        $order = $API->DB->from( "orders" )
            ->where([
                "sourse_contact" => $contact["id"],
                "not status_id" => ["21", "22", "25", "26"]
            ])
            ->orderBy("created_at desc")
            ->limit(1)
            ->fetch();

        $allOrder = $API->DB->from( "orders" );

        $orders = $API->DB->from( "orders" )
            ->where([
                "sourse_contact" => $contact["id"]
            ]);

        $contact[ "countOrder" ] = count($allOrder);

        $orderStatus = $API->DB->from( "orderStatuses" )
            ->where( "id", $order[ "status_id" ] )
            ->limit(1)
            ->fetch();

        if ( $order[ "id" ] ) {

            $contact[ "order" ][ "href" ] = "orders/update/" . $order[ "id" ];
            $contact[ "order" ][ "title" ] = $order[ "id" ];

            $contact[ "orderStatus" ] = [

                "value" => $order[ "status_id" ],
                "title" => $orderStatus[ "title" ]

            ];

        } else {

            $contact[ "order" ][ "value" ] = "";
            $contact[ "order" ][ "title" ] = "нет";

        }

        $filteredContacts[] = $contact;

    }

    /**
     * Запись в выдачу
     */
    $response[ "data" ] = $filteredContacts;


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

        $cars = [];

        foreach ( $response[ "data" ] as $key => $driver ) {

            if ( in_array( $driver[ "orderStatus" ][ "value" ], $orderStatuses ) ) {

                $cars[] = $driver;

            }

            $response[ "data" ] = $cars;
            $response[ "data" ] = array_slice($response[ "data" ], $limit * $requestData->page - $limit, $limit);

        }

    }



    if ( $orders_count_from ) {

        $filteredOrders = [];

        foreach ( $response[ "data" ] as $contact ) {

            $orders = $API->DB->from( "orders" )
                ->where( "sourse_contact", $contact[ "id" ] );

            if ( $orders_count_from <= count($orders) ) {

                $filteredOrders[] = $contact;

            }

        }

        /**
         * Запись в выдачу
         */
        $response[ "data" ] = $filteredOrders;

    }

    if ( $orders_count_to ) {

        $filteredOrders = [];

        foreach ( $response[ "data" ] as $contact ) {

            $orders = $API->DB->from( "orders" )
                ->where( "sourse_contact", $contact[ "id" ] );

            if ( $orders_count_to >= count($orders) ) {

                $filteredOrders[] = $contact;

            }

        }

        /**
         * Запись в выдачу
         */
        $response[ "data" ] = $filteredOrders;

    }

    if ( $orders_cost_from ) {

        $filteredOrders = [];

        foreach ( $response[ "data" ] as $contact ) {

            $orders = $API->DB->from( "orders" )
                ->where( "sourse_contact", $contact[ "id" ] );

            $cost = 0;

            foreach ( $orders as $order ) {

                $cost += $order[ "cost" ];

            }

            if ( $orders_cost_from <= $cost ) {

                $filteredOrders[] = $contact;

            }

        }

        /**
         * Запись в выдачу
         */
        $response[ "data" ] = $filteredOrders;

    }

    if ( $orders_cost_to ) {

        $filteredOrders = [];

        foreach ( $response[ "data" ] as $contact ) {

            $orders = $API->DB->from( "orders" )
                ->where( "sourse_contact", $contact[ "id" ] );

            $cost = 0;

            foreach ( $orders as $order ) {

                $cost += $order[ "cost" ];

            }

            if ( $orders_cost_to >= $cost ) {

                $filteredOrders[] = $contact;

            }

        }

        /**
         * Запись в выдачу
         */
        $response[ "data" ] = $filteredOrders;


    }

}


//if ( $requestData->context->block === "form_list" ) {
//
//    $filteredContacts = [];
//
//    foreach ( $response[ "data" ] as $contact ) {
//
//        if ( $contact[ "is_in_company" ] == "Y" ) $API->returnResponse( $contact, 500 );
//
//        $filteredContacts[] = $contact;
//
//    }
//
//    /**
//     * Запись в выдачу
//     */
//    $response[ "data" ] = $filteredContacts;
//
//}