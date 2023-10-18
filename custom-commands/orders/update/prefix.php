<?php
/**
 * Получение информации о заказе перед изменением
 */
$previousValue = $API->DB->from( "orders" )
    ->where( [
        "id" => $requestData->id
    ] )
    ->limit( 1 )
    ->fetch();

/**
 * Получение детальной информации о водителе
 */
$driverDetail = $API->DB->from( "users" )
    ->where( [
        "id" => $previousValue['driver_id']
    ] )
    ->limit( 1 )
    ->fetch();

/**
 * Получение детальной информации об автомобиле
 */
$carDetail = $API->DB->from( "cars" )
    ->where( [
        "id" => $previousValue['car_id']
    ] )
    ->limit( 1 )
    ->fetch();

/**
 * Получение детальной информации о автомобиле после изменения поля "Автомобиль" у заказа
 */
$newCar = $API->DB->from( "cars" )
->where( [
    "id" => $requestData->car_id
] )
->limit( 1 )
->fetch();

/**
 * Получение детальной информации о водителее после изменения поля "Водитель" у заказа
 */
$newDriver = $API->DB->from( "users" )
->where( [
    "id" => $requestData->driver_id
] )
->limit( 1 )
->fetch();

/**
 * Изменение суммы заказов водителя и автомобилья
 */
if ( $requestData->cost ) {

    /**
     * Изменение суммы заказов авто если изменяется цена и авто
     */
    if ( $requestData->car_id && $requestData->car_id != $carDetail['id'] ){

        $API->DB->update( "cars" )
            ->set( [
                "sumOrder" => $carDetail['sumOrder'] - $previousValue['cost'],
                "countOrder" => $carDetail['countOrder'] - 1
            ] )
            ->where( "id", $carDetail['id'] )
            ->execute();

        $API->DB->update( "cars" )
            ->set( [
                "sumOrder" => $newCar['sumOrder'] + $requestData->cost,
                "countOrder" => $newCar['countOrder'] + 1
            ] )
            ->where( "id", $newCar['id'] )
            ->execute();

    }

    /**
     * Изменение суммы заказов авто если изменяется только цена
     */
    if ( ! $requestData->car_id ) {

        $API->DB->update( "cars" )
        ->set( [
        "sumOrder" => $carDetail['sumOrder'] - $previousValue['cost'] + $requestData->cost
        ] )
        ->where( "id", $carDetail['id'])
        ->execute();
    }

    /**
     * Изменение суммы заказов водителя если изменяется цена и водитель
     */
    if (  $requestData->driver_id && $requestData->driver_id != $driverDetail['id'] ) {

        $API->DB->update( "users" )
            ->set( [
                "sumOrder" => $driverDetail['sumOrder'] - $previousValue['cost'],
                "countOrder" => $driverDetail['countOrder'] - 1
            ] )
            ->where( "id", $driverDetail['id'] )
            ->execute();

        $API->DB->update( "users" )
            ->set( [
                "sumOrder" => $newDriver['sumOrder'] + $requestData->cost,
                "countOrder" => $newDriver['countOrder'] + 1
            ] )
            ->where( "id", $newDriver['id'] )
            ->execute();

    }

    /**
     * Изменение суммы заказов воджителя если изменяется только цена
     */
    if ( ! $requestData->driver_id ) {

        $API->DB->update( "users" )
        ->set( [
        "sumOrder" => $driverDetail['sumOrder'] - $previousValue['cost'] + $requestData->cost
        ] )
        ->where( "id", $driverDetail['id'])
        ->execute();

    }

} else {

    /**
     * Изменение суммы заказов авто если изменяется только авто а цена заказа остается прежней
     */
    if ( $requestData->car_id && $requestData->car_id != $carDetail['id'] ){
        $API->DB->update( "cars" )
            ->set( [
                "sumOrder" => $carDetail['sumOrder'] - $previousValue['cost'],
                "countOrder" => $carDetail['countOrder'] - 1
            ] )
            ->where( "id", $carDetail['id'] )
            ->execute();

        $API->DB->update( "cars" )
            ->set( [
                "sumOrder" => $newCar['sumOrder'] + $previousValue['cost'],
                "countOrder" => $newCar['countOrder'] + 1
            ] )
            ->where( "id", $newCar['id'] )
            ->execute();

    }

    /**
     * Изменение суммы заказов водителя если изменяется только водитель а цена заказа остается прежней
     */
    if ( $requestData->driver_id && $requestData->driver_id != $driverDetail['id'] ) {

        $API->DB->update( "users" )
            ->set( [
                "sumOrder" => $driverDetail['sumOrder'] - $previousValue['cost'],
                "countOrder" => $driverDetail['countOrder'] - 1
            ] )
            ->where( "id", $driverDetail['id'] )
            ->execute();

        $API->DB->update( "users" )
            ->set( [
                "sumOrder" => $newDriver['sumOrder'] + $previousValue['cost'],
                "countOrder" => $newDriver['countOrder'] + 1
            ] )
            ->where( "id", $newDriver['id'] )
            ->execute();

    }

}

/**
 * Изменение количество пройденных миль водителя
 */
if ( $requestData->miles ) {

    /**
     * Изменение количество пройденных миль авто если изменяется мили но авто то же
     */
    if ( ! $requestData->car_id ) {

        $API->DB->update( "cars" )
            ->set( [
                "miles" => (float)$carDetail['miles'] - (float)$previousValue['miles'] + (float)$requestData->miles
            ] )
            ->where( "id", $carDetail['id'] )
            ->execute();

    }

    /**
     * Изменение количество пройденных миль авто если изменяется мили и авто
     */
    if ( $requestData->car_id && $requestData->car_id != $carDetail['id'] ){

        $API->DB->update( "cars" )
            ->set( [
                "miles" => $carDetail['miles'] - $previousValue['miles'],
            ] )
            ->where( "id", $carDetail['id'] )
            ->execute();

        $API->DB->update( "cars" )
            ->set( [
                "sumOrder" => $newCar['miles'] + $requestData->miles,
            ] )
            ->where( "id", $newCar['id'] )
            ->execute();

        }

    /**
     * Изменение количество пройденных миль водителя если изменяются мили но водитель то же
     */
    if ( ! $requestData->driver_id ) {

        $API->DB->update( "users" )
            ->set( [
                "miles" => (float)$driverDetail['miles'] - (float)$previousValue['miles'] + (float)$requestData->miles
            ] )
            ->where( "id", $driverDetail['id'] )
            ->execute();

    }

    /**
     * Изменение количество пройденных миль водителя если изменяется мили и водитель
     */
    if ( $requestData->driver_id && $requestData->driver_id != $driverDetail['id'] ) {

        $API->DB->update( "users" )
            ->set( [
                "miles" => $driverDetail['miles'] - $previousValue['miles'],
            ] )
            ->where( "id", $driverDetail['id'] )
            ->execute();

        $API->DB->update( "users" )
            ->set( [
                "miles" => $newDriver['miles'] + $requestData->miles,
            ] )
            ->where( "id", $newDriver['id'] )
            ->execute();


    }

} else {

    /**
     * Изменение количество пройденных миль авто если изменяется авто а мили нет
     */
    if ( $requestData->car_id != $carDetail['id'] ){

        $API->DB->update( "cars" )
            ->set( [
                "miles" => $carDetail['miles'] - $previousValue['miles'],
            ] )
            ->where( "id", $carDetail['id'] )
            ->execute();

        $API->DB->update( "cars" )
            ->set( [
                "miles" => $newCar['miles'] + $previousValue['miles'],
            ] )
            ->where( "id", $newCar['id'] )
            ->execute();

    }

    /**
     * Изменение количество пройденных миль водителя если изменяется водитель а мили нет
     */
    if ( $requestData->driver_id != $driverDetail['id'] ) {

        $API->DB->update( "users" )
            ->set( [
                "miles" => $driverDetail['miles'] - $previousValue['miles'],
            ] )
            ->where( "id", $driverDetail['id'] )
            ->execute();

        $API->DB->update( "users" )
            ->set( [
                "miles" => $newDriver['miles'] + $previousValue['miles'],

            ] )
            ->where( "id", $newDriver['id'] )
            ->execute();

    }


}


/**
 * Запись в таблицу истории заказов, при изменении статуса
 */
if ( $requestData->status_id ) {
    $API->DB->insertInto( "ordersHistory" )
        ->values( [
            "order_id" => $requestData->id,
            "from_status_id" => $previousValue[ "status_id" ],
            "to_status_id" => $requestData->status_id,
        ] )
        ->execute();

} // if. $requestData->status_id

if ( $requestData->sender_id ) {

    $API->DB->update( "users" )
        ->set( "is_sender", "N"  )
        ->where( "id", $previousValue[ "sender_id" ] )
        ->execute();

}


if ( $requestData->recipient_id  ) {

    $API->DB->update( "users" )
        ->set( "is_recipient", "N"  )
        ->where( "id", $previousValue[ "recipient_id" ] )
        ->execute();

}