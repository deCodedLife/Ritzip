<?php

/**
 * Автоподстановка пользователя
 */
if ( $requestData->context->form == "order" ) {

    $order = $API->DB->from( "orders" )
        ->where( "id", $requestData->context->row_id )
        ->limit( 1 )
        ->fetch();

    $formFieldValues[ "company_id" ][ "is_visible" ] = false;

    $formFieldValues[ "user_id" ][ "value" ] = $order[ "responsible_id" ];
    $formFieldValues[ "user_id" ][ "is_visible" ] = true;

    $formFieldValues[ "order_id" ][ "value" ] = $requestData->context->row_id;
    $formFieldValues[ "order_id" ][ "is_visible" ] = false;

}

if ( $requestData->context->form == "expense" ) {

    $formFieldValues[ "expense_id" ][ "value" ] = $requestData->context->row_id;
    $formFieldValues[ "user_id" ][ "is_visible" ] = false;
    $formFieldValues[ "order_id" ][ "is_visible" ] = false;
    $formFieldValues[ "company_id" ][ "is_visible" ] = false;

}

if ( $requestData->context->form == "reminders" ) {

    $formFieldValues[ "user_id" ][ "value" ] = $requestData->context->row_id;
    $formFieldValues[ "order_id" ][ "is_visible" ] = false;
    $formFieldValues[ "company_id" ][ "is_visible" ] = false;
    $formFieldValues[ "expense_id" ][ "is_visible" ] = false;

}


if ( $requestData->context->form == "company" ) {

    $formFieldValues[ "company_id" ][ "value" ] = $requestData->context->row_id;
    $formFieldValues[ "order_id" ][ "is_visible" ] = false;
    $formFieldValues[ "user_id" ][ "is_visible" ] = true;
    $formFieldValues[ "expense_id" ][ "is_visible" ] = false;

}

if ( $requestData->context->form == "contact" ) {

    $formFieldValues[ "user_id" ][ "value" ] = $requestData->context->row_id;
    $formFieldValues[ "company_id" ][ "is_visible" ] = false;
    $formFieldValues[ "order_id" ][ "is_visible" ] = false;
    $formFieldValues[ "expense_id" ][ "is_visible" ] = false;

}

