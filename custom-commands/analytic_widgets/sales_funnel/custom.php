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
 * Получение заказов
 */
$orders = $API->DB->from( "orders" )
    ->select( null )->select( [ "id", "status_id" ] )
    ->limit( 0 );

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

    foreach ( $ordersHistory as $orderEvent )
        if ( $orderEvent[ "to_status_id" ] != 3 ) $conversion[ "success" ][ "value" ]++;
            else $conversion[ "canceled" ][ "value" ]++;


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