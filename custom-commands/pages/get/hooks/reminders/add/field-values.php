<?php

/**
 * Автоподстановка пользователя
 */

$order = $API->DB->from( "orders" )
    ->where( "id", $requestData->context->row_id )
    ->limit( 1 )
    ->fetch();

$formFieldValues[ "user_id" ] = $order[ "responsible_id" ];



