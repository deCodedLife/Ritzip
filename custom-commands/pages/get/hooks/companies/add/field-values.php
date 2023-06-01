<?php

/**
 * Автоподстановка контактов
 */
if ( ( $requestData->context->form == "contacts" ) && $requestData->context->row_id )
    $formFieldValues[ "main_contact_id" ] = $requestData->context->row_id;

/**
 * Автоподстановка водителя
 */
if ( ( $requestData->context->form == "companies" ) && $requestData->context->row_id )
    $formFieldValues[ "driver_id" ] = $requestData->context->row_id;