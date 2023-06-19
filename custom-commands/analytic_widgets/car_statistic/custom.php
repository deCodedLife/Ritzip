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
 * Получение детальной информации об автомобиле
 */
$carDetail = $API->DB->from( "cars" )
    ->where( "id", $requestData->car_id )
    ->limit( 1 )
    ->fetch();


$returnReport[] = [
    "value" => number_format ( $carDetail[ "countOrder" ], 0, '.', ' ' ) . " шт",
    "description" => "Кол-во заказов",
    "icon" => "",
    "prefix" => "",
    "postfix" => [],
    "background" => "info",
    "detail" => []
];

$returnReport[] = [
    "value" => "\$". number_format ( $carDetail[ "sumOrder" ], 0, '.', ' ' ),
    "description" => "Сумма заказов",
    "icon" => "",
    "prefix" => "",
    "postfix" => [],
    "background" => "info",
    "detail" => []
];
$returnReport[] = [
    "value" => number_format ( $carDetail[ "miles" ], 0, '.', ' ' ) . " миль",
    "description" => "Расстояние",
    "icon" => "",
    "prefix" => "",
    "postfix" => [],
    "background" => "info",
    "detail" => []
];


$API->returnResponse( $returnReport );
