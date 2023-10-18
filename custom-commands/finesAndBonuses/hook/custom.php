<?php

$formFieldsUpdate = [];

if ( $requestData->userType == "driver" ) {

    $formFieldsUpdate[ "dispatcher_id" ][ "is_visible" ] = false;
    $formFieldsUpdate[ "driver_id" ][ "is_visible" ] = true;

} else if ( $requestData->userType == "dispatcher" ) {

    $formFieldsUpdate[ "driver_id" ][ "is_visible" ] = false;
    $formFieldsUpdate[ "dispatcher_id" ][ "is_visible" ] = true;

}


if ( $requestData->bonusOrFine == "fine" ) {

    if ( $requestData->userType == "driver" ) {

        $formFieldsUpdate[ "dispatcherFineType" ][ "is_visible" ] = false;
        $formFieldsUpdate[ "dispatcherBonusType" ][ "is_visible" ] = false;
        $formFieldsUpdate[ "driverFineType" ][ "is_visible" ] = true;
        $formFieldsUpdate[ "driverBonusType" ][ "is_visible" ] = false;

    } else if ( $requestData->userType == "dispatcher" ) {

        $formFieldsUpdate[ "dispatcherFineType" ][ "is_visible" ] = true;
        $formFieldsUpdate[ "dispatcherBonusType" ][ "is_visible" ] = false;
        $formFieldsUpdate[ "driverFineType" ][ "is_visible" ] = false;
        $formFieldsUpdate[ "driverBonusType" ][ "is_visible" ] = false;

    }

} else if ( $requestData->bonusOrFine == "bonus" ) {

    if ( $requestData->userType == "driver" ) {

        $formFieldsUpdate[ "dispatcherFineType" ][ "is_visible" ] = false;
        $formFieldsUpdate[ "dispatcherBonusType" ][ "is_visible" ] = false;
        $formFieldsUpdate[ "driverFineType" ][ "is_visible" ] = false;
        $formFieldsUpdate[ "driverBonusType" ][ "is_visible" ] = true;

    } else if ( $requestData->userType == "dispatcher" ) {

        $formFieldsUpdate[ "dispatcherFineType" ][ "is_visible" ] = false;
        $formFieldsUpdate[ "dispatcherBonusType" ][ "is_visible" ] = true;
        $formFieldsUpdate[ "driverFineType" ][ "is_visible" ] = false;
        $formFieldsUpdate[ "driverBonusType" ][ "is_visible" ] = false;

    }

}


$API->returnResponse( $formFieldsUpdate );
