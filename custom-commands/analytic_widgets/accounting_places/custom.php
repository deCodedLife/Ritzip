<?php

/**
 * @file
 * Отчет по кол7зичеству мест
 */

/**
 * Сформированный отчет
 */
$returnReport = [];

/**
 * Получение заказа
 */
$order = $API->DB->from( "orders" )
    ->where( "id", $requestData->id )
    ->limit( 1 )
    ->fetch();


$returnReport[] = [
    "value" => $order["placeCount"],
    "description" => "Мест ( всего )",
    "icon" => "",
    "prefix" => "",
    "postfix" => [],
    "background" => "info",
    "detail" => []
];

$returnReport[] = [
    "value" => $order["placeOccupied"],
    "description" => "Мест ( занято )",
    "icon" => "",
    "prefix" => "",
    "postfix" => [],
    "background" => "info",
    "detail" => []
];
$returnReport[] = [
    "value" => $order["placeFree"],
    "description" => "Мест ( Свободно )",
    "icon" => "",
    "prefix" => "",
    "postfix" => [],
    "background" => "info",
    "detail" => []
];


$API->returnResponse( $returnReport );
