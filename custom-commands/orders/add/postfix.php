<?php
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
 * Изменение количество пройденных миль водителя
 */
if ( $requestData->miles && $requestData->driver_id ) {

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

if ( $requestData->cost ) {

    $carUpdateFields[ "sumOrder" ] = $carDetail[ "sumOrder" ] + $requestData->cost;
    $driverUpdateFields[ "sumOrder" ] = $driverDetail[ "sumOrder" ] + $requestData->cost;

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
