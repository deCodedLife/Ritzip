<?php

/**
 * Автоподстановка компании
 */
if ( ( $requestData->context->form == "companies" ) && $requestData->context->row_id ) {

    $formFieldValues[ "company_id" ][ "is_visible" ] = false;
    $formFieldValues[ "company_id" ][ "value" ] = $requestData->context->row_id;

}