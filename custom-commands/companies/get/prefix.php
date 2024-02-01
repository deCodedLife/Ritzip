<?php

if ( $requestData->is_recipient == "N" ) {

    unset($requestData->is_recipient);

}

if ( $requestData->is_sender == "N" ) {

    unset($requestData->is_sender);

}

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

    $limit = $requestData->limit;
    $requestData->limit = 0;
    $orders_count_from = $requestData->orders_count_from;
    unset( $requestData->orders_count_from );
    unset( $requestData->limit );

} // if. $requestData->orders_count_from

if ( $requestData->orders_count_to ) {

    $limit = $requestData->limit;
    $requestData->limit = 0;
    $orders_count_to = $requestData->orders_count_to;
    unset( $requestData->orders_count_to );
    unset( $requestData->limit );

} // if. $requestData->orders_count_to


/**
 * Фильтр по сумме сделок
 */

if ( $requestData->orders_cost_from ) {

    $limit = $requestData->limit;
    $requestData->limit = 0;
    $orders_cost_from = $requestData->orders_cost_from;
    unset( $requestData->orders_cost_from );
    unset( $requestData->limit );

} // if. $requestData->orders_cost_from

if ( $requestData->orders_cost_to ) {

    $limit = $requestData->limit;
    $requestData->limit = 0;
    $orders_cost_to = $requestData->orders_cost_to;
    unset( $requestData->orders_cost_to );
    unset( $requestData->limit );

} // if. $requestData->orders_cost_to


if ( $requestData->order ) {

    $orderRq = $requestData->order;
    $limit = $requestData->limit;
    $requestData->limit = 0;

    unset( $requestData->order );
    unset( $requestData->limit );

} // if. $requestData->order

if ( $requestData->task_id ) {

    $taskRq = $requestData->task_id;
    $limit = $requestData->limit;
    $requestData->limit = 0;

    unset( $requestData->task_id );
    unset( $requestData->limit );

} // if. $requestData->order


if ( $requestData->taskStatus ) {

    $taskStatuses = $requestData->taskStatus;
    $limit = $requestData->limit;
    $requestData->limit = 0;

    unset( $requestData->taskStatus );
    unset( $requestData->limit );

} // if. $requestData->taskStatus

if ( $requestData->orderStatus ) {

    $orderStatuses = $requestData->orderStatus;
    $limit = $requestData->limit;
    $requestData->limit = 0;

    unset( $requestData->orderStatus );
    unset( $requestData->limit );

} // if. $requestData->orderStatus