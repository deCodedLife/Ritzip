<?php

/**
 * Автоподстановка заявки
 */

if ( ( $requestData->context->form == "notes" ) && $requestData->context->row_id )
    $formFieldValues[ "order_id" ] = $requestData->context->row_id;
