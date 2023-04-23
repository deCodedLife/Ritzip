<?php

/**
 * Подстановка контакта в компанию
 */
if ( $requestData->company_id ) {

    $API->DB->update( "companies" )
        ->set( "contact_id", $requestData->id )
        ->where( [
            "id" => $requestData->id,
            "is_system" => "N"
        ] )
        ->execute();

} // if. $requestData->company_id