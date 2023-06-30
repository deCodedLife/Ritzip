<?php

/**
 * Автоподстановка заявки
 */

if ( ( $requestData->context->form == "order" ) && $requestData->context->row_id )
    $formFieldValues[ "order_id" ] = $requestData->context->row_id;
