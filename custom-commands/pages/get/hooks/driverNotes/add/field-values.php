<?php

/**
 * Автоподстановка водителя
 */

if ( ( $requestData->context->form == "driverNotes" ) && $requestData->context->row_id )
    $formFieldValues[ "driver_id" ] = $requestData->context->row_id;

