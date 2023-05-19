<?php

/**
 * Автоподстановка контактов
 */
if ( ( $requestData->context->form == "contacts" ) && $requestData->context->row_id )
    $formFieldValues[ "main_contact_id" ] = $requestData->context->row_id;