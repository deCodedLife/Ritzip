<?php
/**
 * @file
 * Отчет "Отчет водителя"
 */

/**
 * Сформированный отчет
 */
$returnReport = [];

/**
 * Вывод всех этементов
 */
$requestData->limit = 0;
$requestData->page = 1;

/**
 * Список заказов отчета
 */
$list = $API->sendRequest( "driverReport", "get", $requestData );

/**
 * Страховка
 */
$insurance = 0;

/**
 * Диспетчерский сбор
 */
$dispatchCollection = 0;

/**
 * Использование приложений
 */
$usingApp = 0;

/**
 * Look Book
 */
$lookBook = 0;

/**
 * Обход списка
 */
foreach ( $list as $item ) {

    /**
     * Получение водителя
     */
    $driverDetail = $API->DB->from( "users" )
        ->where( [
            "id" => $item->driver_id,
            "driverType" => "operator"
        ] )
        ->limit( 1 )
        ->fetch();

    $insurance += $driverDetail[ "insuranceAmount" ];

    $dispatchCollection += $item->cost * ( $driverDetail[ "dispatchFee" ] / 100 );
    $usingApp += $driverDetail[ "usingApp" ];

}

/**
 * Страховка
 */
$returnReport[] = [
    "value" => $insurance,
    "description" => "Страховка",
    "size" => 1,
    "icon" => "",
    "prefix" => "$",
    "postfix" => [],
    "background" => "info",
    "detail" => []
];

/**
 * Диспетчерский сбор
 */
$returnReport[] = [
    "value" => $dispatchCollection,
    "description" => "Диспетчерский сбор",
    "size" => 1,
    "icon" => "",
    "prefix" => "$",
    "postfix" => [],
    "background" => "info",
    "detail" => []
];

/**
 * Использование приложений
 */
$returnReport[] = [
    "value" => $usingApp,
    "description" => "Использование приложений",
    "size" => 1,
    "icon" => "",
    "prefix" => "$",
    "postfix" => [],
    "background" => "info",
    "detail" => []
];

/**
 * Использование приложений
 */
$returnReport[] = [
    "value" => $lookBook,
    "description" => "Look Book",
    "size" => 1,
    "icon" => "",
    "prefix" => "$",
    "postfix" => [],
    "background" => "info",
    "detail" => []
];


$API->returnResponse( $returnReport );
