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

if ( $requestData->paymentType_id == 1 ) {

    $API->DB->insertInto( "expenses" ) // Запись в таблицу истории оплат
        ->values( [
            "category_id" => 2,
            "cost" => $requestData->payNow,
            "order_id" => $orderDetail[ "id" ],
            "author_id" => $API::$userDetail->id,
            "contact_id" => $orderDetail[ "contact_id" ],
            "company_id" => $orderDetail[ "company_id" ],
            "car_id" => $orderDetail[ "car_id" ],
            "driver_id" => $orderDetail[ "driver_id" ],
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

if ( $requestData->sender_id ) {

    $API->DB->update( "users" )
        ->set( "is_sender", "Y"  )
        ->where( "id", $requestData->sender_id )
        ->execute();

}


if ( $requestData->recipient_id  ) {

    $API->DB->update( "users" )
        ->set( "is_recipient", "Y"  )
        ->where( "id", $requestData->recipient_id  )
        ->execute();

}