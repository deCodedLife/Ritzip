<?php

/**
 * Автоподстановка роли
 */

$roleArticle = substr( $requestData->page, 0, strpos( $requestData->page, "/" ) );

$roleDetail = $API->DB->from( "roles" )
    ->where( "article", $roleArticle )
    ->limit( 1 )
    ->fetch();

if ( $roleDetail ) $formFieldValues = [
    "role_id" => (int) $roleDetail[ "id" ],
];