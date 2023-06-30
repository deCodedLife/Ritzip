<?php

/**
 * Автоподстановка пользователя
 */
if ( $requestData->context->form == "order" ) {

    $order = $API->DB->from( "orders" )
        ->where( "id", $requestData->context->row_id )
        ->limit( 1 )
        ->fetch();

    $formFieldValues[ "user_id" ] = $order[ "responsible_id" ];

}

if ( $requestData->context->form == "reminders" ) {

    $formFieldValues[ "user_id" ][ "value" ] = $requestData->context->row_id;
    $formFieldValues[ "user_id" ][ "is_visible" ] = false;

}


if ( $requestData->context->form == "company" ) {

    $formFieldValues[ "company_id" ][ "value" ] = $requestData->context->row_id;
    $formFieldValues[ "company_id" ][ "is_visible" ] = false;

}

