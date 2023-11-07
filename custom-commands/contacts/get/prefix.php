<?php

/**
 * Фильтр по дате
 */
$requestSettings[ "filter" ][ "role_id" ] = 13;

if ( $requestData->created_at ) {

    $requestSettings[ "filter" ][ "created_at >= ?" ] = $requestData->created_at . " 00:00:00";
    $requestSettings[ "filter" ][ "created_at <= ?" ] = $requestData->created_at . " 23:59:59";

    unset( $requestData->created_at );

} // if. $requestData->created_at

if ( $requestData->companyCategory_id ) {

    $requestSettings[ "filter" ][ "companyCategory_id" ] = (int)$requestData->companyCategory_id;

    unset( $requestData->companyCategory_id );

} // if. $requestData->created_a