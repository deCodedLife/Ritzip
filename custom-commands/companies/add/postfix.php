<?php

/**
 * Подстановка компании в контакт
 */
if ( $requestData->contact_id ) {

    $API->DB->update( "contacts" )
        ->set( "company_id", $insertId )
        ->where( [
            "id" => $insertId,
            "is_system" => "N"
        ] )
        ->execute();

} // if. $requestData->contact_id