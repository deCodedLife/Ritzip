<?php

/**
 * Фильтр по дате
 */

if ( $requestData->created_at ) {

    $requestSettings[ "filter" ][ "created_at >= ?" ] = $requestData->created_at . " 00:00:00";
    $requestSettings[ "filter" ][ "created_at <= ?" ] = $requestData->created_at . " 23:59:59";

    unset( $requestData->created_at );

} // if. $requestData->created_at


/**
 * Фильтр по сумме
 */

if ( $requestData->cost_from ) {

    $requestSettings[ "filter" ][ "cost >= ?" ] = $requestData->cost_from;
    unset( $requestData->cost_from );

} // if. $requestData->cost_from

if ( $requestData->cost_to ) {

    $requestSettings[ "filter" ][ "cost <= ?" ] = $requestData->cost_to;
    unset( $requestData->cost_to );

} // if. $requestData->cost_to