<?php
/**
 * @file
 * Отчет "Отчет диспетчера"
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
$list = $API->sendRequest( "dispatcherReport", "get", $requestData );

/**
 * Количество заказов
 */
$ordersCount = 0;

/**
 * Сумма заказов
 */
$personalConsumption = 0;

/**
 * Сумма заказов
 */
$wages = 0;


/**
 * Бонусов и штрафов
 */
$finesAndBonusesSum = 0;


/**
 * Обход списка
 */
foreach ( $list as $item ) {

    /**
     * Подсчет заказов
     */
    $ordersCount++;

    /**
     * Подсчет суммы заказов
     */
    $personalConsumption += $item->cost;


    /**
     * Получение расходов по ЗП
     */
    $wagesExpenses = $API->DB->from( "expenses" )
        ->where( [

            "order_id" => $item->id,
            "category_id" => 9,

        ] );

    /**
     * Обход расходов по топливу
     */
    foreach ( $wagesExpenses as $expense ) {

        /**
         * Расчет всех личных расходов
         */
        $wages += $expense[ "cost" ];

    }

    /**
     * Получение бонусов и штрафов
     */
    $finesAndBonuses = $API->DB->from( "finesAndBonuses" )
        ->where( "order_id", $item->id );

    /**
     * Обход бонусов и штрафов
     */
    foreach ( $finesAndBonuses as $fineAndBonus ) {

        if ( $fineAndBonus[ "bonusOrFine" ] == "bonus" ) {

            $finesAndBonusesSum = $finesAndBonusesSum + $fineAndBonus[ "sum" ];

        } else if ( $fineAndBonus[ "bonusOrFine" ] == "fine" ) {

            $finesAndBonusesSum = $finesAndBonusesSum - $fineAndBonus[ "sum" ];

        }
    }

}

/**
 * Итого заказов
 */
$returnReport[] = [
    "value" => $ordersCount,
    "description" => "Итого заказов",
    "size" => 1,
    "icon" => "",
    "prefix" => "",
    "postfix" => [],
    "background" => "info",
    "detail" => []
];

/**
 * Сумма заказов
 */
$returnReport[] = [
    "value" => $personalConsumption,
    "description" => "Сумма заказов",
    "size" => 1,
    "icon" => "",
    "prefix" => "$",
    "postfix" => [],
    "background" => "info",
    "detail" => []
];

/**
 * Сумма З/П
 */
$returnReport[] = [
    "value" => $wages,
    "description" => "Сумма З/П",
    "size" => 2,
    "icon" => "",
    "prefix" => "$",
    "postfix" => [],
    "background" => "info",
    "detail" => []
];

/**
 * Бонусы и штрафы
 */
$returnReport[] = [
    "value" => $finesAndBonusesSum,
    "description" => "Бонусы и штрафы",
    "size" => 2,
    "icon" => "$",
    "prefix" => "",
    "postfix" => [],
    "background" => "info",
    "detail" => []
];

/**
 * З/П Итого
 */
$returnReport[] = [
    "value" => $wages + $finesAndBonusesSum,
    "description" => "З/П Итого",
    "size" => 2,
    "icon" => "$",
    "prefix" => "",
    "postfix" => [],
    "background" => "info",
    "detail" => []
];

$API->returnResponse( $returnReport );
