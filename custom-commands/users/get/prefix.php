<?php

/**
 * Принудительный фильтр раздела "Остальные пользователи"
 */
if ( ( $requestData->context->block === "list" ) && !$requestData->role_id )
    $requestSettings[ "filter" ][ "role_id > ?" ] = 10;


/**
 * Фильтр по дате
 */

if ( $requestData->created_at ) {

    $requestSettings[ "filter" ][ "created_at >= ?" ] = $requestData->created_at . " 00:00:00";
    $requestSettings[ "filter" ][ "created_at <= ?" ] = $requestData->created_at . " 23:59:59";

    unset( $requestData->created_at );

} // if. $requestData->created_at->block


