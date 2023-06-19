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
 * Получение детальной информации о водителе
 */
$driverDetail = $API->DB->from( "users" )
    ->where( "id", $requestData->id )
    ->limit( 1 )
    ->fetch();


$returnReport[] = [
    "value" => number_format ( $driverDetail[ "countOrder" ], 0, '.', ' ' ) . " шт",
    "description" => "Кол-во заказов",
    "icon" => "",
    "prefix" => "",
    "postfix" => [],
    "background" => "info",
    "detail" => []
];

$returnReport[] = [
    "value" => "\$". number_format ( $driverDetail[ "sumOrder" ], 0, '.', ' ' ),
    "description" => "Сумма заказов",
    "icon" => "",
    "prefix" => "",
    "postfix" => [],
    "background" => "info",
    "detail" => []
];
$returnReport[] = [
    "value" => number_format ( $driverDetail[ "miles" ], 0, '.', ' ' ) . " миль",
    "description" => "Расстояние",
    "icon" => "",
    "prefix" => "",
    "postfix" => [],
    "background" => "info",
    "detail" => []
];

$API->returnResponse( $returnReport );
