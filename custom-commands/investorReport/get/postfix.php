<?php

/**
 * Формирование списка
 */

/**
 * Сформированный список авто
 */
$returnCars = [];

/**
 * Обход авто
 */
foreach ( $response[ "data" ] as $car ) {

    $driver_cars = $API->DB->from( "driver_cars" )
        ->where( "car_id", $car[ "id" ] );

    foreach ( $driver_cars as $driver_car ) {

        $orderFilter =  [
            "car_id" => $driver_car[ "id" ],
            "created_at >= ?" => $requestData->created_at_from,
            "created_at <= ?" => $requestData->created_at_to,
        ];

        $orders = $API->DB->from( "orders" )
            ->where( $orderFilter );

        foreach ( $orders as $order ) {

            $car[ "order_id" ][] = [

                "title" => $order[ "id" ],
                "value" => $order[ "id" ],

            ];

        }
    }

    $expensesFilter =  [
        "car_id" => $car[ "id" ],
        "created_at >= ?" => $requestData->created_at_from,
        "created_at <= ?" => $requestData->created_at_to,
    ];

    $expenses = $API->DB->from( "expenses" )
        ->where( $expensesFilter );

    foreach ( $expenses as $expense ) {

        switch ( $expense [ "category_id" ] ) {

            case 1:
                $car[ "adminExpenses" ] += $expense[ "cost" ];
                break;

            case 9:
                if ( $expense[ "dispatchers_id" ] ) {

                    $car[ "dispatcherExpenses" ] += $expense[ "cost" ];

                }

                foreach ( $car[ "driver_id" ] as $driver ) {

                    if ( $expense[ "driver_id" ] == $driver[ "value" ] ) {

                        $car[ "driverSalary" ] += $expense[ "cost" ];

                    }

                }

                break;

            case 5:
                $car[ "moreExpenses" ] += $expense[ "cost" ];
                break;

            case 4:
                $car[ "fuelExpenses" ] += $expense[ "cost" ];
                break;

            case 3:
                $car[ "repairExpenses" ] += $expense[ "cost" ];
                break;

            case 11:
                $car[ "insuranceExpenses" ] += $expense[ "cost" ];
                break;

        }

    }

    $returnCars[] = $car;

} // foreach. $response[ "data" ]


$response[ "data" ] = $returnCars;
