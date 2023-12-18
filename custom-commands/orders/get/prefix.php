<?php

/**
 * Фильтр по сумме
 */

$userDetail = $API->DB->from( "users" )
    ->where( "id", $API::$userDetail->id)
    ->limit( 1 )
    ->fetch();

if ( $userDetail[ "role_id" ] == 13 ) {

    $requestSettings[ "filter" ][ "sourse_contact" ] = $userDetail[ "id" ];

} // if. $requestData->cost_from

if ( $userDetail[ "role_id" ] == 34 ) {

    $requestSettings[ "filter" ][ "responsible_id" ] = $userDetail[ "id" ];

} // if. $requestData->cost_from


if ( $requestData->cost_from ) {

    $requestSettings[ "filter" ][ "cost >= ?" ] = $requestData->cost_from;
    unset( $requestData->cost_from );

} // if. $requestData->cost_from


if ( $requestData->cost_to ) {

    $requestSettings[ "filter" ][ "cost <= ?" ] = $requestData->cost_to;
    unset( $requestData->cost_to );

} // if. $requestData->cost_to


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


/**
 * Фильтр по расстоянию
 */

if ( $requestData->miles_from ) {

    $requestSettings[ "filter" ][ "miles >= ?" ] = $requestData->miles_from;
    unset( $requestData->miles_from );

} // if. $requestData->miles

if ( $requestData->miles_to ) {

    $requestSettings[ "filter" ][ "miles <= ?" ] = $requestData->miles_to;
    unset( $requestData->miles_to );

} // if. $requestData->miles


/**
 * Фильтр по позициям
 */

if ( $requestData->placeOccupied_from ) {

    $requestSettings[ "filter" ][ "placeOccupied >= ?" ] = $requestData->placeOccupied_from;
    unset( $requestData->placeOccupied_from );

} // if. $requestData->miles

if ( $requestData->placeOccupied_to ) {

    $requestSettings[ "filter" ][ "placeOccupied <= ?" ] = $requestData->placeOccupied_to;
    unset( $requestData->placeOccupied_to );

} // if. $requestData->miles

if ( $requestData->car_id ) {

    $limit = $requestData->limit;
    $requestData->limit = 0;

    $carId = $requestData->car_id;
    unset( $requestData->car_id );

} // if. $requestData->car_id

