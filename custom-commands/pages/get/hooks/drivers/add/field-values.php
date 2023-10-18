<?php

/**
 * Автоподстановка роли
 */

$roleArticle = substr( $requestData->page, 0, strpos( $requestData->page, "/" ) );

$roleDetail = $API->DB->from( "roles" )
    ->where( "article", $roleArticle )
    ->limit( 1 )
    ->fetch();

if ( $roleDetail ) {

    $formFieldValues[ "role_id" ] = [
        "is_visible" => false,
        "value" => (int) $roleDetail[ "id" ]
    ];

}

if ( ( $requestData->context->form == "companies" ) && $requestData->context->row_id ) {

    $formFieldValues[ "company_id" ][ "is_visible" ] = false;
    $formFieldValues[ "company_id" ][ "value" ] = $requestData->context->row_id;

}





