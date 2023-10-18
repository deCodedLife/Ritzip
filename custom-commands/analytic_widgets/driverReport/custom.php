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
 * Расходы по топливу
 */
$fuelConsumption = 0;

/**
 * Личные расходы
 */
$personalConsumption = 0;

/**
 * Обход списка
 */
foreach ( $list as $item ) {

    /**
     * Получение расходов по топливу
     */
    $fuelExpenses = $API->DB->from( "expenses" )
        ->where( [

            "order_id" => $item->id,
            "category_id" => 4,

        ] );

    /**
     * Обход расходов по топливу
     */
    foreach ( $fuelExpenses as $expense ) {

        /**
         * Расчет всех личных расходов
         */
        $fuelConsumption += $expense[ "cost" ];

    }

    /**
     * Получение личных расходов
     */
    $personalExpenses = $API->DB->from( "expenses" )
        ->where( [

            "order_id" => $item->id,
            "driver_id" => $item->driver_id,

        ] );

    /**
     * Обход личных расходов
     */
    foreach ( $personalExpenses as $expense ) {

        /**
         * Расчет всех личных расходов
         */
        $personalConsumption += $expense[ "cost" ];

    }

}

/**
 * Расход по топливу
 */
$returnReport[] = [
    "value" => $fuelConsumption,
    "description" => "Расход по топливу",
    "size" => 2,
    "icon" => "",
    "prefix" => "$",
    "postfix" => [],
    "background" => "info",
    "detail" => []
];

/**
 * Личные расходы
 */
$returnReport[] = [
    "value" => $personalConsumption,
    "description" => "Личные расходы",
    "size" => 1,
    "icon" => "",
    "prefix" => "$",
    "postfix" => [],
    "background" => "info",
    "detail" => []
];

/**
 * Look Book
 */
$returnReport[] = [
    "value" => 0,
    "description" => "Look Book",
    "size" => 1,
    "icon" => "$",
    "prefix" => "",
    "postfix" => [],
    "background" => "info",
    "detail" => []
];


$API->returnResponse( $returnReport );
