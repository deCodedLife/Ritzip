<?php

/**
 * Автоподстановка клиента
 */

if ( ( $requestData->context->form == "order" ) && $requestData->context->row_id )
    $formFieldValues[ "order_id" ][ "value" ] = $requestData->context->row_id;
    $formFieldValues[ "order_id" ][ "is_visible" ] = false;
