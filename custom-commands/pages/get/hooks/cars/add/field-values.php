<?php

/**
 * Автоподстановка водителя
 */

if ( ( $requestData->context->form == "cars" ) && $requestData->context->row_id ) {

    $formFieldValues[ "driver_id" ][ "is_visible" ] = false;
    $formFieldValues[ "employees_id" ][ "is_visible" ] = false;

    $formFieldValues[ "driver_id" ][ "value" ] = $requestData->context->row_id;
    $formFieldValues[ "employees_id" ][ "value" ] = $requestData->context->row_id;

}

if ( ( $requestData->context->form == "tasks" ) && $requestData->context->row_id ) {

    $formFieldValues[ "driver_id" ][ "is_visible" ] = false;
    $formFieldValues[ "employees_id" ][ "is_visible" ] = false;

    $formFieldValues[ "driver_id" ][ "value" ] = $requestData->context->row_id;
    $formFieldValues[ "employees_id" ][ "value" ] = $requestData->context->row_id;

}

if ( ( $requestData->context->form == "companies" ) && $requestData->context->row_id ) {

    $formFieldValues[ "company_id" ][ "is_visible" ] = false;
    $formFieldValues[ "company_id" ][ "value" ] = $requestData->context->row_id;

}
$formFieldValues[ "responsible_id" ][ "value" ] = $API::$userDetail->id;
