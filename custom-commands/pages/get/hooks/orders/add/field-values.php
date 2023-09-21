<?php

/**
 * Автоподстановка клиента
 */

if ( ( $requestData->context->form == "orders" ) && $requestData->context->row_id )
    $formFieldValues[ "car_id" ] = $requestData->context->row_id;

/**
 * Автоподстановка водителя
 */

 if ( ( $requestData->context->form == "orders" ) && $requestData->context->row_id )
 $formFieldValues[ "employee_id" ] = $requestData->context->row_id;


$formFieldValues[ "responsible_id" ][ "value" ] = $API::$userDetail->id;
