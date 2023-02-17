<?php

/**
 * @file
 * Отчет "Воронка продаж"
 */


/**
 * Сформированный отчет
 */
$returnReport = [];

/**
 * Список заказов по статусам
 */
$ordersByStatus = [];

/**
 * Список ID заказов.
 * Используется для формирования графика
 */
$ordersID = [];


/**
 * Получение фильтров
 */

$filter = [];

if ( $requestData->start_at ) $filter[ "created_at >= ?" ] = $requestData->start_at;
if ( $requestData->end_at ) $filter[ "created_at <= ?" ] = $requestData->end_at;
if ( $requestData->source_id ) $filter[ "source_id" ] = $requestData->source_id;


/**
 * Получение заказов
 */
$orders = $API->DB->from( "orders" )
    ->select( null )->select( [ "id", "status_id" ] )
    ->where( $filter )
    ->limit( 1000 );

/**
 * Получение ID заказов
 */
foreach ( $orders as $order ) $ordersID[] = $order[ "id" ];

/**
 * Получение статусов заказов
 */
$orderStatuses = $API->DB->from( "orderStatuses" )
    ->orderBy( "priority asc" )
    ->limit( 0 );


/**
 * Получение кол-ва заказов по статусам
 */
foreach ( $orders as $order )
    $ordersByStatus[ $order[ "status_id" ] ]++;


/**
 * Формирование отчета
 */

foreach ( $orderStatuses as $orderStatus ) {

    /**
     * Игнорирование статуса "Отклонено"
     */
    if ( $orderStatus[ "id" ] == 3 ) continue;


    /**
     * Получение конверсии перехода между статусами
     */

    $conversion = [
        "success" => [
            "title" => "Следующий статус",
            "value" => 0
        ],
        "canceled" => [
            "title" => "Отменено",
            "value" => 0
        ]
    ];

    $ordersHistory = $API->DB->from( "ordersHistory" )
        ->where( "from_status_id", $orderStatus[ "id" ] )
        ->limit( 0 );

    foreach ( $ordersHistory as $orderEvent ) {

        /**
         * Игнорирование заказов, не подходящих по фильтру
         */
        if ( !in_array( $orderEvent[ "order_id" ], $ordersID ) ) continue;


        if ( $orderEvent[ "to_status_id" ] != 3 ) $conversion[ "success" ][ "value" ]++;
            else $conversion[ "canceled" ][ "value" ]++;

    } // foreach. $ordersHistory


    /**
     * Кол-во заказов по умолчанию
     */
    if ( !$ordersByStatus[ $orderStatus[ "id" ] ] ) $ordersByStatus[ $orderStatus[ "id" ] ] = 0;

    $returnReport[] = [
        "value" => $orderStatus[ "title" ],
        "description" => "Кол-во заказов: " . $ordersByStatus[ $orderStatus[ "id" ] ],
        "icon" => "",
        "prefix" => "",
        "postfix" => [],
        "background" => "info",
        "detail" => [
            "type" => "donut",
            "settings" => [
                "char" => $conversion
            ]
        ]
    ];

} // foreach. $orderStatuses


$API->returnResponse( $returnReport );