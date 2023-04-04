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
 * Фильтр по кол-ву сделок
 */

if ( $requestData->orders_count_from ) {

    $requestSettings[ "filter" ][ "orders_count >= ?" ] = $requestData->orders_count_from;
    unset( $requestData->orders_count_from );

} // if. $requestData->orders_count_from

if ( $requestData->orders_count_to ) {

    $requestSettings[ "filter" ][ "orders_count <= ?" ] = $requestData->orders_count_to;
    unset( $requestData->orders_count_to );

} // if. $requestData->orders_count_to


/**
 * Фильтр по сумме сделок
 */

if ( $requestData->orders_cost_from ) {

    $requestSettings[ "filter" ][ "orders_cost >= ?" ] = $requestData->orders_cost_from;
    unset( $requestData->orders_cost_from );

} // if. $requestData->orders_cost_from

if ( $requestData->orders_cost_to ) {

    $requestSettings[ "filter" ][ "orders_cost <= ?" ] = $requestData->orders_cost_to;
    unset( $requestData->orders_cost_to );

} // if. $requestData->orders_cost_to