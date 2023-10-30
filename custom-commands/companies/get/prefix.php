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

$limit = $requestData->limit;

if ( $requestData->orders_count_from ) {

    $requestData->limit = 0;
    $orders_count_from = $requestData->orders_count_from;
    unset( $requestData->orders_count_from );

} // if. $requestData->orders_count_from

if ( $requestData->orders_count_to ) {

    $requestData->limit = 0;
    $orders_count_to = $requestData->orders_count_to;
    unset( $requestData->orders_count_to );

} // if. $requestData->orders_count_to


/**
 * Фильтр по сумме сделок
 */

if ( $requestData->orders_cost_from ) {

    $requestData->limit = 0;
    $orders_cost_from = $requestData->orders_cost_from;
    unset( $requestData->orders_cost_from );

} // if. $requestData->orders_cost_from

if ( $requestData->orders_cost_to ) {

    $requestData->limit = 0;
    $orders_cost_to = $requestData->orders_cost_to;
    unset( $requestData->orders_cost_to );

} // if. $requestData->orders_cost_to