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

    $requestSettings[ "multiply_filter" ][ "role_id != ?" ] = [ 4, 13 ];

} // if. $requestData->context->page === "users"


