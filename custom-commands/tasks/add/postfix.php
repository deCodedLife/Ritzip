<?php

/**
 * Добавление уведомлений
 */

$API->addNotification(
    "system_alerts",
    "Добавлена задача",
    $requestData->description,
    "info",
    $requestData->employee_id
);


/**
 * Добавление логов
 */

/**
 * Добавление логов
 */

if ( $requestData->contact_id ) {

    $API->addLog( [
        "table_name" => "contacts",
        "description" => "Добавлена задача: $requestData->title",
        "row_id" => $requestData->contact_id
    ], $requestData );

} // if. $requestData->contact_id

if ( $requestData->company_id ) {

    $API->addLog( [
        "table_name" => "companies",
        "description" => "Добавлена задача: $requestData->title",
        "row_id" => $requestData->company_id
    ], $requestData );

} // if. $requestData->company_id

if ( $requestData->order_id ) {

    $API->addLog( [
        "table_name" => "orders",
        "description" => "Добавлена задача: $requestData->title",
        "row_id" => $requestData->order_id
    ], $requestData );

} // if. $requestData->order_id

if ( $requestData->car_id ) {

    $API->addLog( [
        "table_name" => "cars",
        "description" => "Добавлена задача: $requestData->title",
        "row_id" => $requestData->car_id
    ], $requestData );

} // if. $requestData->car_id

if ( $requestData->driver_id ) {

    $API->addLog( [
        "table_name" => "users",
        "description" => "Добавлена задача: $requestData->title",
        "row_id" => $requestData->driver_id
    ], $requestData );

} // if. $requestData->driver_id