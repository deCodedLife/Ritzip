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