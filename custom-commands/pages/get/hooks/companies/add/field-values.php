<?php

/**
 * Автоподстановка контактов
 */
if ( ( $requestData->context->form == "contacts" ) && $requestData->context->row_id ) {

    $formFieldValues[ "main_contact_id" ][ "is_visible" ] = false;
    $formFieldValues[ "main_contact_id" ][ "value" ] = $requestData->context->row_id;

}

/**
 * Автоподстановка водителя
 */
if ( ( $requestData->context->form == "companies" ) && $requestData->context->row_id ) {

    $formFieldValues[ "driver_id" ][ "is_visible" ] = false;
    $formFieldValues[ "driver_id" ][ "value" ] = $requestData->context->row_id;

}

/**
 * Автоподстановка водителя
 */
if ( ( $requestData->context->form == "cars" ) && $requestData->context->row_id ) {

    $formFieldValues[ "vehicles_id" ] = $requestData->context->row_id;

}


/**
 * Автоподстановка ответственного
 */

$formFieldValues[ "user_id" ][ "value" ] = $API::$userDetail->id;

