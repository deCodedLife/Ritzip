<?php

/**
 * Автоподстановка водителя
 */

if ( ( $requestData->context->form == "carNotes" ) && $requestData->context->row_id )
    $formFieldValues[ "car_id" ] = $requestData->context->row_id;

