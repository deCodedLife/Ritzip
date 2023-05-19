<?php

/**
 * Автоподстановка компании
 */
if ( ( $requestData->context->form == "companies" ) && $requestData->context->row_id )
    $formFieldValues[ "company_id" ] = $requestData->context->row_id;