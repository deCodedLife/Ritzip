<?php
///**
// * Получение информации о заказе перед удалением
// */
//$previousValue = $API->DB->from( "orders" ) // get order info
//->where( [
//    "id" => $requestData->id
//] )
//->limit( 1 )
//->fetch();
//
///**
// * Получение детальной информации о водителе
// */
//$driverDetail = $API->DB->from( "users" )
//    ->where( [
//        "id" => $previousValue [ "driver_id" ]
//    ] )
//    ->limit( 1 )
//    ->fetch();
//
///**
// * Получение детальной информации об автомобиле
// */
//$carDetail = $API->DB->from( "cars" )
//    ->where( [
//        "id" => $previousValue[ "car_id"]
//    ] )
//    ->limit( 1 )
//    ->fetch();
//
///**
// * Получение детальной информации об прицепе
// */
//$trailerDetail = $API->DB->from( "trailers" )
//    ->where( [
//        "id" => $previousValue[ "trailer_id" ]
//    ] )
//    ->limit( 1 )
//    ->fetch();
//
///**
// * Обновление полей у водителя и авто
// */
//
//$API->DB->update( "users" )
//    ->set( [
//     "sumOrder" => $driverDetail['sumOrder'] - $previousValue['cost'],
//     "countOrder" => $driverDetail['countOrder'] - 1,
//     "miles" => (float)$driverDetail['miles'] - (float)$previousValue['miles']
//    ] )
//    ->where( "id", $driverDetail['id'] )
//    ->execute();
//
//$API->DB->update( "cars" )
//    ->set( [
//     "sumOrder" => $carDetail['sumOrder'] - $previousValue['cost'],
//     "countOrder" => $carDetail['countOrder'] - 1,
//     "miles" => (float)$carDetail['miles'] - (float)$previousValue['miles']
//    ] )
//    ->where( "id", $carDetail['id'] )
//    ->execute();
//
//$API->DB->update( "trailers" )
//    ->set( [
//        "sumOrder" => $trailerDetail['sumOrder'] - $previousValue['cost'],
//        "countOrder" => $trailerDetail['countOrder'] - 1,
//        "miles" => (float)$trailerDetail['miles'] - (float)$previousValue['miles']
//    ] )
//    ->where( "id", $trailerDetail['id'] )
//    ->execute();
