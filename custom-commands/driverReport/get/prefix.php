<?php

/**
 * Фильтр по дате
 */

if ( $requestData->created_at_from ) {

    $requestSettings[ "filter" ][ "created_at >= ?" ] = $requestData->created_at_from;
    unset( $requestData->created_at_from );

} // if. $requestData->created_at

if ( $requestData->created_at_to ) {

    $requestSettings[ "filter" ][ "created_at <= ?" ] = $requestData->created_at_to;
    unset( $requestData->created_at_to );

} // if. $requestData->created_at


if ( $requestData->sort_by == "tachometer" || $requestData->sort_by == "dispatcherPercent" || $requestData->sort_by == "parkingNumber" || $requestData->sort_by == "milePrice" || $requestData->sort_by == "fuelConsumption" ) {

    $limit = $requestData->limit;
    $sort_by = $requestData->sort_by;
    $sort_order = $requestData->sort_order;

    $requestData->limit = 0;
    unset($requestData->sort_by);
    unset($requestData->sort_order);

}