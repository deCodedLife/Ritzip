<?php

/**
 * Автоподстановка заявки
 */

if ( ( $requestData->context->form == "order" ) && $requestData->context->row_id )
    $formFieldValues[ "order_id" ] =
        [
            "is_visible" => false,
            "value" => $requestData->context->row_id
        ];
