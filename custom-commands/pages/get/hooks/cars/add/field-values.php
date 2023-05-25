<?php

/**
 * Автоподстановка водителя
 */

if ( ( $requestData->context->form == "cars" ) && $requestData->context->row_id )
    $formFieldValues[ "employees_id" ] = $requestData->context->row_id;

