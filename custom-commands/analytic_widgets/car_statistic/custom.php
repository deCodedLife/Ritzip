<?php

/**
 * @file
 * Отчет "Статистика водителя"
 */


/**
 * Сформированный отчет
 */
$returnReport = [];

/**
 * Сумма заказов
 */
$ordersPrice = 0;

/**
 * Сумма миль
 */
$ordersMiles = 0;

/**
 * Получение заказов
 */
$orders = $API->DB->from( "orders" )
    ->where( "car_id", $requestData->car_id )
    ->limit( 1000 );

/**
 * Получение суммы заказов
 */
foreach ( $orders as $order ) {

    $ordersPrice += $order[ "cost" ];
    $ordersMiles += $order[ "miles" ];
}


$returnReport[] = [
    "value" => "Кол-во заказов",
    "description" => number_format ( count( $orders ), 0, '.', ' ' ) . " шт",
    "icon" => "",
    "prefix" => "",
    "postfix" => [],
    "background" => "info",
    "detail" => []
];

$returnReport[] = [
    "value" => "Сумма заказов",
    "description" => "\$". number_format ( $ordersPrice, 0, '.', ' ' ),
    "icon" => "",
    "prefix" => "",
    "postfix" => [],
    "background" => "info",
    "detail" => []
];
$returnReport[] = [
    "value" => "Расстояние",
    "description" => number_format ( $ordersMiles, 0, '.', ' ' ) . " миль",
    "icon" => "",
    "prefix" => "",
    "postfix" => [],
    "background" => "info",
    "detail" => []
];


$API->returnResponse( $returnReport );
