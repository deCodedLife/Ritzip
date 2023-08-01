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
