<?php

/**
 * Автоподстановка водителя
 */

if ( ( $requestData->context->form == "carFiles" ) && $requestData->context->row_id )
    $formFieldValues[ "car_id" ] = $requestData->context->row_id;

