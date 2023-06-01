<?php

$orderDetail = $API->DB->from( "orders" ) // получение информации о заявке
    ->where( "id", $requestData->id )
    ->limit( 1 )
    ->fetch();

/**
 * Подсчет свободных мест
 */ 
$vehicles = $API->DB->from( "orders_vehicles" )
    ->where( "order_id", $requestData->id )
    ->limit( 20 );

$API->DB->update( "orders" ) 
    ->set( [
        "placeOccupied" => count( $vehicles ),
        "placeFree" => (int) $orderDetail['placeCount'] - count( $vehicles )
    ] )
    ->where( "id", $requestData->id )
    ->execute();

    
/**
 * Изменение остатка при оплате
 */  
if ( $requestData->paymentType_id && $requestData->payNow ) {

    $API->DB->update( "orders" ) // обновление полей "Оплачено" и "остатка по оплате"
        ->set( [
            "needPay" => (float) $orderDetail['cost'] - (float) $orderDetail['paidFor'] - (float) $requestData->payNow,
            "paidFor" => (float) $requestData->payNow + (float) $orderDetail['paidFor'],
            "paymentType_id" => (int) $requestData->paymentType_id
        ] )
        ->where( "id", $requestData->id )
        ->execute();

    $API->returnResponse($orderDetail);
    
    $API->DB->insertInto( "orderPayHistory" ) // Запись в таблицу истории оплат
    ->values( [
        "cost" => (float) $orderDetail['cost'],
        "needPay" => (float) $orderDetail['cost'] - (float) $orderDetail['paidFor'] - (float) $requestData->payNow,
        "paidFor" => (float) $requestData->payNow + (float) $orderDetail['paidFor'],
        "order_id" => (int) $requestData->id,
        "paymentType_id" => (int) $requestData->paymentType_id
    ] )
    ->execute();

}


/**
 * Изменение остатка при изменении цены
 */

if ( $requestData->cost ) {

    $API->DB->update( "orders" ) // обновление поля "остатка по оплате"
        ->set( [
        "needPay" => (float) $orderDetail['cost'] - (float) $orderDetail['paidFor']
        ] )
        ->where( "id", $requestData->id )
        ->execute();

}
    

/**
 * Смена статуса при отмене заявки
 */

if ( $requestData->cancellationReason) {
    
    $API->DB->update( "orders" ) 
    ->set( [
    "status_id" => 3
    ] )
    ->where( "id", $requestData->id )
    ->execute();

}


/**
 * Подсчет свободных мест в заявке
 */


