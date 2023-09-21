<?php

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
