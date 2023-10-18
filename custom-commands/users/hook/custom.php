<?php

/**
 * Обновление полей формы
 */
$formFieldsUpdate = [];


if ( $requestData->driverType == "operator" ) {

    $formFieldsUpdate[ "insuranceAmount" ][ "is_visible" ] = true;
    $formFieldsUpdate[ "insurancePeriod_from" ][ "is_visible" ] = true;
    $formFieldsUpdate[ "insurancePeriod_to" ][ "is_visible" ] = true;
    $formFieldsUpdate[ "dispatchFee" ][ "is_visible" ] = true;
    $formFieldsUpdate[ "usingApp" ][ "is_visible" ] = true;
    $formFieldsUpdate[ "lookBook" ][ "is_visible" ] = true;

} else if ( $requestData->driverType == "driver" ) {

    $formFieldsUpdate[ "insuranceAmount" ][ "is_visible" ] = false;
    $formFieldsUpdate[ "insurancePeriod_from" ][ "is_visible" ] = false;
    $formFieldsUpdate[ "insurancePeriod_to" ][ "is_visible" ] = false;
    $formFieldsUpdate[ "dispatchFee" ][ "is_visible" ] = false;
    $formFieldsUpdate[ "usingApp" ][ "is_visible" ] = false;
    $formFieldsUpdate[ "lookBook" ][ "is_visible" ] = false;

}


$API->returnResponse( $formFieldsUpdate );