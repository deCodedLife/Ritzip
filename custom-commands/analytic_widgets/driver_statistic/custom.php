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
    ->where( "employee_id", $requestData->employee_id )
    ->limit( 1000 );

/**
 * Получение суммы заказов
 */
foreach ( $orders as $order ) {

    $ordersPrice += $order[ "cost" ];
    $ordersMiles += $order[ "miles" ];
}


$returnReport[] = [
    "value" => number_format ( count( $orders ), 0, '.', ' ' ) . " шт",
    "description" => "Кол-во заказов",
    "icon" => "",
    "prefix" => "",
    "postfix" => [],
    "background" => "info",
    "detail" => []
];

$returnReport[] = [
    "value" => "\$". number_format ( $ordersPrice, 0, '.', ' ' ),
    "description" => "Сумма заказов",
    "icon" => "",
    "prefix" => "",
    "postfix" => [],
    "background" => "info",
    "detail" => []
];
$returnReport[] = [
    "value" => number_format ( $ordersMiles, 0, '.', ' ' ) . " миль",
    "description" => "Расстояние",
    "icon" => "",
    "prefix" => "",
    "postfix" => [],
    "background" => "info",
    "detail" => []
];

$API->returnResponse( $returnReport );
