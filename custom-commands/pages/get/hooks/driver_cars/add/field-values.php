<?php

/**
 * Автоподстановка заявки
 */

if ( ( $requestData->context->form == "driver" ) && $requestData->context->row_id )
    $formFieldValues[ "driver_id" ] =
        [
            "is_visible" => false,
            "value" => $requestData->context->row_id
        ];
