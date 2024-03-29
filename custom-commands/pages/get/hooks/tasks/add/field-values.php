<?php

/**
 * Автоподстановка
 */

$formFieldValues[ "author_id" ] = $API::$userDetail->id;
$formFieldValues[ "is_visible_everyone" ] = "Y";
$formFieldValues[ "watcher_id" ] = $API::$userDetail->id;
$formFieldValues[ "employee_id" ] = $API::$userDetail->id;


if ( ( $requestData->context->form == "tasks" ) && $requestData->context->employee_id )
    $formFieldValues[ "car_id" ] = $requestData->context->row_id;

if ( ( $requestData->context->form == "carTasks" ) && $requestData->context->row_id ) {

    $formFieldValues[ "car_id" ][ "is_visible" ] = true;
    $formFieldValues[ "car_id" ][ "value" ] = $requestData->context->row_id;
    $formFieldValues[ "binding" ][ "value" ] = "car";

}

if ( ( $requestData->context->form == "driverTasks" ) && $requestData->context->row_id ) {

    $formFieldValues[ "driver_id" ][ "is_visible" ] = true;
    $formFieldValues[ "driver_id" ][ "value" ] = $requestData->context->row_id;
    $formFieldValues[ "binding" ][ "value" ] = "driver";

}

if ( ( $requestData->context->form == "clientTasks" ) && $requestData->context->row_id ) {

    $formFieldValues[ "client_id" ][ "is_visible" ] = false;
    $formFieldValues[ "client_id" ][ "value" ] = $requestData->context->row_id;

}

if ( ( $requestData->context->form == "contactTasks" ) && $requestData->context->row_id ) {

    $formFieldValues[ "contact_id" ][ "is_visible" ] = true;
    $formFieldValues[ "contact_id" ][ "value" ] = $requestData->context->row_id;
    $formFieldValues[ "binding" ][ "value" ] = "contact";

}

if ( ( $requestData->context->form == "expenseTasks" ) && $requestData->context->row_id ) {

    $formFieldValues[ "expense_id" ][ "is_visible" ] = true;
    $formFieldValues[ "expense_id" ][ "value" ] = $requestData->context->row_id;
    $formFieldValues[ "binding" ][ "value" ] = "expense";

}

if ( ( $requestData->context->form == "companyTasks" ) && $requestData->context->row_id ) {

    $formFieldValues[ "company_id" ][ "is_visible" ] = true;
    $formFieldValues[ "company_id" ][ "value" ] = $requestData->context->row_id;
    $formFieldValues[ "binding" ][ "value" ] = "company";

}

if ( ( $requestData->context->form == "orderTasks" ) && $requestData->context->row_id ) {

    $formFieldValues[ "order_id" ][ "is_visible" ] = false;
    $formFieldValues[ "order_id" ][ "value" ] = $requestData->context->row_id;
    $formFieldValues[ "binding" ][ "value" ] = "order";

}

if ( ( $requestData->context->form == "trailers" ) && $requestData->context->row_id ) {

    $formFieldValues[ "trailer_id" ][ "is_visible" ] = true;
    $formFieldValues[ "trailer_id" ][ "value" ] = $requestData->context->row_id;
    $formFieldValues[ "binding" ][ "value" ] = "trailer";

}


