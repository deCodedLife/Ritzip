<?php

/**
 * Фильтрация по авто
 */
if ( $carId ) {

    /**
     * Отфильтраный писок заказов
     */
    $filteredOrders = [];

    /**
     * Обход заказов
     */
    foreach ( $response[ "data" ] as $order ) {

        /**
         * Сравнение ID авто
         */
        if ( $carId == $order[ "car_id" ][ "title" ] ) {

            /**
             * Запись в массив выдачи
             */
            $filteredOrders[] = $order;

        } // if. $carId == $order[ "car_id" ][ "title" ]

    } // foreach. $response[ "data" ]

    /**
     * Запись в выдачу
     */
    $response[ "data" ] = $filteredOrders;

    /**
     * Формирование pages_count и rows_count
     */
    $response[ "detail" ] = [

        "pages_count" => ceil(count($response[ "data" ]) / $limit),
        "rows_count" => count($response[ "data" ])

    ];

    /**
     * Формирование лимита выдачи
     */
    $response[ "data" ] = array_slice($response[ "data" ], $limit * $requestData->page - $limit, $limit);

}  // if. $carId



/**
 * Вывод vin авто в список
 */
foreach ( $response[ "data" ] as $order ) {

    /**
     * Детальная информаци об авто
     */
    $carDetail = $API->DB->from( "cars" )
        ->where( "id", $order[ "car_id" ][ "title" ] )
        ->limit( 1 )
        ->fetch();

    /**
     * Заменя значения поля
     */
    $order[ "car_id" ] =
        [
            "value" => $order[ "car_id" ][ "value" ],
            "title" => $carDetail[ "vin" ]
        ];

    $returnOrders[] = $order;

} // foreach. $response[ "data" ]

$response[ "data" ] = $returnOrders;


/**
 * Формирование заголовков и описания заявок для воронки
 */
if ( $requestData->context->block === "funnel" ) {

    /**
     * Сформированный список заявок
     */
    $returnOrders = [];


    /**
     * Обход заявок
     */
    foreach ( $response[ "data" ] as $order ) {

        $returnOrders[] = [
            "id" => $order[ "id" ],
            "title" => $order[ "origin_city" ] . " -> " . $order[ "destination_city" ],
            "description" => $order[ "created_at" ],
            "status_id" => $order[ "status_id" ]
        ];

    } // foreach. $response[ "data" ]


    $response[ "data" ] = $returnOrders;

} // if. $requestData->context->block === "funnel"

