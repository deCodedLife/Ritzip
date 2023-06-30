<?php
/**
 * Детальная информация заказа
 */
$orderDetail = $API->DB->from( "orders" )
    ->where( "id", $requestData->id )
    ->limit( 1 )
    ->fetch();

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

    $API->DB->insertInto( "orderPayHistory" ) // Запись в таблицу истории оплат
    ->values( [
        "cost" => (float) $orderDetail['cost'],
        "needPay" => (float) $orderDetail['cost'] - (float) $orderDetail['paidFor'] - (float) $requestData->payNow,
        "paidFor" => (float) $requestData->payNow + (float) $orderDetail['paidFor'],
        "order_id" => (int) $requestData->id,
        "payNow" => (int) $requestData->payNow,
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



