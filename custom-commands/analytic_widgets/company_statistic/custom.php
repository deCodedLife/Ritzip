<?php

/**
 * @file
 * Отчет "Статистика компании"
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
 * Получение заказов
 */
$orders = $API->DB->from( "orders" )
    ->where( "company_id", $requestData->company_id )
    ->limit( 1000 );

/**
 * Получение суммы заказов
 */
foreach ( $orders as $order ) $ordersPrice += $order[ "cost" ];


$returnReport[] = [
    "value" => "Кол-во заказов",
    "description" => count( $orders ) . " шт",
    "icon" => "",
    "prefix" => "",
    "postfix" => [],
    "background" => "info",
    "detail" => []
];

$returnReport[] = [
    "value" => "Сумма заказов",
    "description" => "\$ $ordersPrice",
    "icon" => "",
    "prefix" => "",
    "postfix" => [],
    "background" => "info",
    "detail" => []
];


$API->returnResponse( $returnReport );