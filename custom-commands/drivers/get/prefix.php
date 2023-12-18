<?php

$requestSettings[ "filter" ][ "role_id" ] = 4;

if ( $requestData->created_at ) {

    $requestSettings[ "filter" ][ "created_at >= ?" ] = $requestData->created_at . " 00:00:00";
    $requestSettings[ "filter" ][ "created_at <= ?" ] = $requestData->created_at . " 23:59:59";

    unset( $requestData->created_at );

} // if. $requestData->created_at

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