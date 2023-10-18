<?php

/**
 * Фильтр по дате
 */

if ( $requestData->created_at_from ) {

    $requestSettings[ "filter" ][ "created_at >= ?" ] = $requestData->created_at_from . " 00:00:00";
    unset( $requestData->created_at_from );

} // if. $requestData->created_at

if ( $requestData->created_at_to ) {

    $requestSettings[ "filter" ][ "created_at <= ?" ] = $requestData->created_at_to . " 23:59:59";
    unset( $requestData->created_at_to );

} // if. $requestData->created_at
