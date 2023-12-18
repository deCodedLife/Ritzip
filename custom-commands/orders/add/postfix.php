<?php

$automationRules = $API->DB->from( "automationRules" )
    ->limit( 1 )
    ->fetch();

if ( $automationRules[ "expense_per_dispatcher" ] == "Y" ) {

    $API->DB->insertInto( "expenses" )
        ->values( [
            "title" => "Расход на услуги диспетчера",
            "order_id" => $requestData->id,
            "dispatchers_id" => $requestData->dispatchers_id,
            "author_id" => $API::$userDetail->id,
            "category_id" => 9,
        ] )
        ->execute();

    if ( $automationRules[ "ex_payment_with_status_not_paid" ] == "Y" ) {

        $API->DB->insertInto( "payments" )
            ->values( [
                "car_id" => $requestData->car_id,
                "driver_id" => $requestData->driver_id,
                "author_id" => $API::$userDetail->id,
                "status_id" => 14,
            ] )
            ->execute();

    }

}

if ( $requestData->owneroperator_id && $requestData->paymentType_id == 1 ) {

    if ( $automationRules[ "owner_order_cash_expense_automatically_generated" ] == "Y" ) {

        $API->DB->insertInto( "expenses" )
            ->values( [
                "title" => "У Owner заказ с оплатой типа- Наличные",
                "order_id" => $requestData->id,
                "author_id" => $API::$userDetail->id,
            ] )
            ->execute();

    }

}

if ( $automationRules[ "expense_per_driver" ] == "Y" ) {

    $API->DB->insertInto( "expenses" )
        ->values( [
            "title" => "Расход ЗП водителя",
            "order_id" => $requestData->id,
            "driver_id" => $requestData->driver_id,
            "author_id" => $API::$userDetail->id,
            "category_id" => 9,
        ] )
        ->execute();

    if ( $automationRules[ "ex_payment_with_status_not_paid" ] == "Y" ) {

        $API->DB->insertInto( "payments" )
            ->values( [
                "car_id" => $requestData->car_id,
                "driver_id" => $requestData->driver_id,
                "author_id" => $API::$userDetail->id,
                "status_id" => 14,
            ] )
            ->execute();

    }

}

/**
 * Создание платежа
 */
$API->DB->insertInto( "payments" )
    ->values( [
        "sum" => $requestData->cost,
        "created_at" => date("Y-m-d H:i:s"),
        "status_id" => 1,
        "responsible_id" => $requestData->responsible_id,
        "object" => "order",
    ] )
    ->execute();

/**
 * Получение детальной информации о водителе
 */
$driverDetail = $API->DB->from( "users" )
    ->where( [
        "id" => $requestData->driver_id
    ] )
    ->limit( 1 )
    ->fetch();

/**
 * Получение детальной информации об автомобиле
 */
$carDetail = $API->DB->from( "cars" )
    ->where( [
        "id" => $requestData->car_id
    ] )
    ->limit( 1 )
    ->fetch();


/**
 * Получение детальной информации об прицепе
 */
$trailerDetail = $API->DB->from( "trailers" )
    ->where( [
        "id" => $requestData->trailer_id
    ] )
    ->limit( 1 )
    ->fetch();

/**
 * Изменение количество пройденных
 */
if ( $requestData->miles ) {

    /**
     * Обновление миль водителя
     */
    $API->DB->update( "users" )
        ->set( [
            "miles" => $requestData->miles + $driverDetail[ "miles" ]
        ] )
        ->where( "id", $requestData->driver_id )
        ->execute();

    /**
     * Обновление миль автомобиля
     */
    $API->DB->update( "cars" )
        ->set( [
            "miles" => $requestData->miles + $carDetail[ "miles" ]
        ] )
        ->where( "id", $requestData->car_id )
        ->execute();

    /**
     * Обновление миль автомобиля
     */
    $API->DB->update( "trailers" )
        ->set( [
            "miles" => $requestData->miles + $trailerDetail[ "miles" ]
        ] )
        ->where( "id", $requestData->trailer_id )
        ->execute();

} // if. $requestData->miles && $requestData->driver_id


/**
 * Заполнение поля "Нужно оплатить"
 */
$API->DB->update( "orders" )
    ->set( [
        "needPay" => $requestData->cost
    ] )
    ->where( "id", $requestData->id )
    ->execute();


/**
 * Расчет значений "Кол-во заказов" и "Сумма заказов"
 */

$carUpdateFields = [ "countOrder" => $carDetail[ "countOrder" ] + 1 ];
$driverUpdateFields = [ "countOrder" => $driverDetail[ "countOrder" ] + 1 ];
$trailerUpdateFields = [ "countOrder" => $trailerDetail[ "countOrder" ] + 1 ];

if ( $requestData->cost ) {

    $carUpdateFields[ "sumOrder" ] = $carDetail[ "sumOrder" ] + $requestData->cost;
    $driverUpdateFields[ "sumOrder" ] = $driverDetail[ "sumOrder" ] + $requestData->cost;
    $trailerUpdateFields[ "sumOrder" ] = $trailerDetail[ "sumOrder" ] + $requestData->cost;

} // if. $requestData->cost


/**
 * Обновление полей у водителя и авто
 */

$API->DB->update( "users" )
    ->set( $carUpdateFields )
    ->where( "id", $requestData->driver_id )
    ->execute();

$API->DB->update( "cars" )
    ->set( $driverUpdateFields )
    ->where( "id", $requestData->car_id )
    ->execute();

$API->DB->update( "trailers" )
    ->set( $trailerUpdateFields )
    ->where( "id", $requestData->trailer_id )
    ->execute();

if ( $requestData->sender_id ) {

    $API->DB->update( "users" )
        ->set( "is_sender", "Y"  )
        ->where( "id", $requestData->sender_id )
        ->execute();

}


if ( $requestData->recipient_id  ) {

    $API->DB->update( "users" )
        ->set( "is_recipient", "Y" )
        ->where( "id", $requestData->recipient_id )
        ->execute();

}
