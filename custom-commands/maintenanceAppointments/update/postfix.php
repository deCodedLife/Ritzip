<?php

/**
 * Получение информации о записи на ТО
 */
$orderDetail = $API->DB->from( "maintenanceAppointments" )
    ->where( [
        "id" => $requestData->id
    ] )
    ->limit( 1 )
    ->fetch();


/**
 * Оплата ТО
 */

if ( $requestData->paid ) {

    /**
     * Получение типа расходов "Оплата ТО"
     */
    $expenseTypeDetail = $API->DB->from( "expenseTypes" )
        ->where( [
            "article" => "maintenanceAppointments"
        ] )
        ->limit( 1 )
        ->fetch();


    /**
     * Подсчет остатка к оплате
     */
    $toPay = $orderDetail[ "to_pay" ] - $requestData->paid;

    /**
     * Добавление расхода
     */
    $API->DB->insertInto( "expenses" )
        ->values( [
            "maintenance_id" => $requestData->id,
            "author_id" => $API::$userDetail->id,
            "type_id" => $expenseTypeDetail[ "id" ],
            "status" => "success",
            "cost" => $requestData->paid,
            "description" => $orderDetail[ "description" ]
        ] )
        ->execute();

    /**
     * Обновление остатка
     */
    $API->DB->update( "maintenanceAppointments" )
        ->set( "to_pay", $toPay )
        ->where( "id", $requestData->id )
        ->execute();

    /**
     * Обновление статуса "Оплачено"
     */
    if ( $toPay <= 0 ) $API->DB->update( "maintenanceAppointments" )
        ->set( "is_payed", "Y" )
        ->where( "id", $requestData->id )
        ->execute();

} // if. $requestData->paid