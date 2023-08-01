<?php

$companiesList = $API->DB->from( "companies" )
    ->innerJoin( "company_contacts on companies.id = company_contacts.company_id" )
    ->where( "company_contacts.contacts_id", $pageDetail[ "row_id" ] );

foreach ( $companiesList as $company ) {

    $category = $API->DB->from( "companyCategories" )
        ->where( "id", $company[ "companyCategory_id" ] )
        ->fetch();
    $formFieldValues[ "companyCategory_id" ][ "value" ][] = $category[ "title" ];

}