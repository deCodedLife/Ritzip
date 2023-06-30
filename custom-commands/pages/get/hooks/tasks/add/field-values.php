<?php

/**
 * Автоподстановка
 */

if ( ( $requestData->context->form == "tasks" ) && $requestData->context->employee_id )
    $formFieldValues[ "car_id" ] = $requestData->context->row_id;

if ( ( $requestData->context->form == "carTasks" ) && $requestData->context->row_id ) {

    $formFieldValues[ "car_id" ][ "is_visible" ] = false;
    $formFieldValues[ "car_id" ][ "value" ] = $requestData->context->row_id;

}

if ( ( $requestData->context->form == "driverTasks" ) && $requestData->context->row_id ) {

    $formFieldValues[ "employee_id" ][ "is_visible" ] = false;
    $formFieldValues[ "employee_id" ][ "value" ] = $requestData->context->row_id;

}

if ( ( $requestData->context->form == "clientTasks" ) && $requestData->context->row_id ) {

    $formFieldValues[ "client_id" ][ "is_visible" ] = false;
    $formFieldValues[ "client_id" ][ "value" ] = $requestData->context->row_id;

}

if ( ( $requestData->context->form == "contactTasks" ) && $requestData->context->row_id ) {

    $formFieldValues[ "employee_id" ][ "is_visible" ] = false;
    $formFieldValues[ "employee_id" ][ "value" ] = $requestData->context->row_id;

}

if ( ( $requestData->context->form == "companyTasks" ) && $requestData->context->row_id ) {

    $formFieldValues[ "company_id" ][ "is_visible" ] = false;
    $formFieldValues[ "company_id" ][ "value" ] = $requestData->context->row_id;

}

