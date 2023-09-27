<?php

/**
 * Фильтр по дате
 */

if ( $requestData->created_at ) {

    $requestSettings[ "filter" ][ "created_at >= ?" ] = $requestData->created_at . " 00:00:00";
    $requestSettings[ "filter" ][ "created_at <= ?" ] = $requestData->created_at . " 23:59:59";

    unset( $requestData->created_at );

} // if. $requestData->created_at->block


if ( $requestData->context->page === "users" ) {

    $requestSettings[ "filter" ][ "role_id != ?" ] = 13;
    $requestSettings[ "filter" ][ "role_id != ?" ] = 3;

} // if. $requestData->context->page === "users"


