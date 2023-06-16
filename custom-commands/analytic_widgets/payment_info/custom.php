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
 * Получение заказов
 */
$order = $API->DB->from( "orders" )
    ->where( "id", $requestData->id )
    ->limit( 1 )
    ->fetch();


$returnReport[] = [
    "value" => $order["needPay"],
    "description" => "Осталось оплатить",
    "icon" => "",
    "prefix" => "",
    "postfix" => [],
    "background" => "info",
    "detail" => []
];

$returnReport[] = [
    "value" => $order["paidFor"],
    "description" => "Оплачено",
    "icon" => "",
    "prefix" => "",
    "postfix" => [],
    "background" => "info",
    "detail" => []
];
$returnReport[] = [
    "value" => $order["cost"],
    "description" => "Общая стоимость",
    "icon" => "",
    "prefix" => "",
    "postfix" => [],
    "background" => "info",
    "detail" => []
];

$API->returnResponse( $returnReport );
