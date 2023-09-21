<?php

/**
 * Название задачи
 */
$taskTitle = $API->DB->from( "tasks" )
    ->where( "id", $requestData->id )
    ->limit( 1 )
    ->fetch()[ "title" ];


/**
 * Добавление логов
 */

if ( $requestData->contact_id ) {

    $API->addLog( [
        "table_name" => "contacts",
        "description" => "Привязана задача: $taskTitle",
        "row_id" => $requestData->contact_id
    ], $requestData );

} // if. $requestData->contact_id

if ( $requestData->company_id ) {

    $API->addLog( [
        "table_name" => "companies",
        "description" => "Привязана задача: $taskTitle",
        "row_id" => $requestData->company_id
    ], $requestData );

} // if. $requestData->company_id

if ( $requestData->order_id ) {

    $API->addLog( [
        "table_name" => "orders",
        "description" => "Привязана задача: $taskTitle",
        "row_id" => $requestData->order_id
    ], $requestData );

} // if. $requestData->order_id

if ( $requestData->car_id ) {

    $API->addLog( [
        "table_name" => "cars",
        "description" => "Привязана задача: $taskTitle",
        "row_id" => $requestData->car_id
    ], $requestData );

} // if. $requestData->car_id

if ( $requestData->driver_id ) {

    $API->addLog( [
        "table_name" => "users",
        "description" => "Привязана задача: $taskTitle",
        "row_id" => $requestData->driver_id
    ], $requestData );

} // if. $requestData->driver_id