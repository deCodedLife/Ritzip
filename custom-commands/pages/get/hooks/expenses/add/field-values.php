<?php

/**
 * Автоподстановка водителя
 */

$formFieldValues[ "author_id" ][ "value" ] = $API::$userDetail->id;

if ( ( $requestData->context->form == "carsExpenses" ) && $requestData->context->row_id ) {

    $formFieldValues[ "car_id" ][ "value" ] = $requestData->context->row_id;

}

if ( ( $requestData->context->form == "driverExpenses" ) && $requestData->context->row_id ) {

    $formFieldValues[ "driver_id" ][ "value" ] = $requestData->context->row_id;

}

if ( ( $requestData->context->form == "orderExpenses" ) && $requestData->context->row_id ) {

    $formFieldValues[ "order_id" ][ "value" ] = $requestData->context->row_id;
    $formFieldValues[ "order_id" ][ "is_visible" ] = false;

}

if ( ( $requestData->context->form == "trailerExpenses" ) && $requestData->context->row_id ) {

    $formFieldValues[ "trailer_id" ][ "value" ] = $requestData->context->row_id;

}
