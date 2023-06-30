<?php

/**
 * Основной контакт
 */

if ( $requestData->is_main === "Y" ) {

    $companyId = $requestData->company_id;

    if ( !$companyId ) $companyId = $API->DB->from( "contacts" )
        ->where( "id", $requestData->id )
        ->limit( 1 )
        ->fetch()[ "company_id" ];


    if ( $companyId ) $API->DB->update( "companies" )
        ->set( "main_contact_id", $requestData->id )
        ->where( [
            "id" => $companyId,
            "is_system" => "N"
        ] )
        ->execute();

} // if. $requestData->is_main === "Y"


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

/**
 * Автоподстановка фамилии
 */
if ( $requestData->title ) {

    $API->DB->update( "users" )
        ->set( "last_name", $requestData->title )
        ->where( [
            "id" => $insertId
        ] )
        ->execute();

}
