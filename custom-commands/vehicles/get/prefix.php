<?php

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

if ( $requestData->status_id ) {

    $statuses = $requestData->status_id;
    $limit = $requestData->limit;
    $requestData->limit = 0;

    unset( $requestData->status_id );
    unset( $requestData->limit );

} // if. $requestData->created_at


