<?php

if ( $requestData->sourceType == "sourse_contact" ) {

    $updatedFields[ "sourse_contact" ][ "is_visible" ] = true;
    $updatedFields[ "company_id" ][ "is_visible" ] = false;

    $updatedFields[ "payer_contact_id" ][ "is_visible" ] = true;
    $updatedFields[ "payer_company_id" ][ "is_visible" ] = false;

}

if ( $requestData->sourceType == "company" ) {

    $updatedFields[ "sourse_contact" ][ "is_visible" ] = false;
    $updatedFields[ "company_id" ][ "is_visible" ] = true;

    $updatedFields[ "payer_company_id" ][ "is_visible" ] = true;
    $updatedFields[ "payer_contact_id" ][ "is_visible" ] = false;

}

$API->returnResponse($updatedFields);