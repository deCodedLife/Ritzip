<?php

$API->DB->update( "users" )
    ->set( "last_name", $requestData->title )
    ->where( [
        "id" => $insertId
    ] )
    ->execute();

/**
 * Подстановка контакта в компанию
 */
if ( $requestData->company_id ) {

    $API->DB->update( "companies" )
        ->set( "contact_id", $insertId )
        ->where( [
            "id" => $insertId,
            "is_system" => "N"
        ] )
        ->execute();

} // if. $requestData->company_id

/**
 * Автоподстановка категории
 */
if ( $requestData->company_id ) {

    $companyDetail = $API->DB->from( "companies" )
        ->where( "id", $requestData->company_id )
        ->limit( 1 )
        ->fetch();

    $API->DB->update( "users" )
        ->set( "companyCategory_id", $companyDetail[ "companyCategory_id" ] )
        ->where( [
            "id" => $insertId
        ] )
        ->execute();


}

