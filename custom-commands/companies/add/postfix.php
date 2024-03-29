<?php

/**
 * Изменение категории контакта при изменении категории компании
 */
if ( $requestData->companyCategory_id || $requestData->contacts_id ) {

    $companyContacts = $API->DB->from( "company_contacts" )
        ->where( "company_id", $requestData->id );

    /**
     * Обход контактов компании
     */
    foreach ( $companyContacts as $companyContact ) {

        $API->DB->update( "users" )
            ->set( "companyCategory_id", $requestData->companyCategory_id )
            ->where( "id", $companyContact[ "contacts_id" ])
            ->execute();

    } // foreach .$companyContacts

} // if. $requestData->companyCategory_id


if ($requestData->driver_id) $API->addLog([
    "table_name" => "orders",
    "description" => "Привязана компания: " . $requestData->title,
    "row_id" => $requestData->driver_id
], $requestData);


if ( $requestData->contacts_id ) {

    $API->DB->update( "users" )
        ->set( [
            "is_in_company" => "Y"
        ] )
        ->where( "id", $requestData->contacts_id )
        ->execute();

}