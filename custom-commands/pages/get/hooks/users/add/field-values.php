<?php

/**
 * Автоподстановка роли
 */

/**
 * Автоподстановка роли
 */
$roleArticle = substr( $requestData->page, 0, strpos( $requestData->page, "/" ) );

$roleDetail = $API->DB->from( "roles" )
    ->where( "article", $roleArticle )
    ->limit( 1 )
    ->fetch();

if ( $roleDetail ) {

    $formFieldValues[ "role_id" ][ "is_visible" ] = false;
    $formFieldValues[ "role_id" ][ "value" ] = (int) $roleDetail[ "id" ];

}

$formFieldValues[ "responsible_id" ][ "value" ] = $API::$userDetail->id;
