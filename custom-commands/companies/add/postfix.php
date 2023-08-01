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
