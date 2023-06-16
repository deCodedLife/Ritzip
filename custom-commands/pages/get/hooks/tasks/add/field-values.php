<?php

/**
 * Автоподстановка клиента
 */

if ( ( $requestData->context->form == "tasks" ) && $requestData->context->employee_id )
    $formFieldValues[ "car_id" ] = $requestData->context->row_id;
