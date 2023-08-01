<?php

/**
 * Автоподстановка заявки
 */

if ( ( $requestData->context->form == "contact" ) && $requestData->context->row_id )
    $formFieldValues[ "company_id" ] =
        [
            "is_visible" => false,
            "value" => $requestData->context->row_id
        ];
