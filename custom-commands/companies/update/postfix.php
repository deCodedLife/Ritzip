<?php

/**
 * Подстановка компании в контакт
 */
if ( $requestData->contact_id ) {

    $API->DB->update( "contacts" )
        ->set( "company_id", $requestData->id )
        ->where( [
            "id" => $requestData->id,
            "is_system" => "N"
        ] )
        ->execute();

} // if. $requestData->contact_id