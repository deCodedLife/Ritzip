<?php
/**
 * Создание привяяязки авто к новому водителю
 */

if ( ( $requestData->context->form == "drivers" ) && $requestData->context->row_id ) {

$API->DB->insertInto( "cars_users" )
->values( [
    "car_id" => $requestData->context->row_id,
    "user_id" => $insertId
] )
->execute();

}

