<?php

/**
 * Обновление полей формы
 */
$formFieldsUpdate = [];


if ( $requestData->salaryType == "percent" ) {

    $formFieldsUpdate[ "salaryPercent" ][ "is_visible" ] = true;
    $formFieldsUpdate[ "salarySum" ][ "is_visible" ] = false;

} else {

    $formFieldsUpdate[ "salaryPercent" ][ "is_visible" ] = false;
    $formFieldsUpdate[ "salarySum" ][ "is_visible" ] = true;

}

if ( $requestData->dispatchFeeType == "percent" ) {

    $formFieldsUpdate[ "dispatchFeePercent" ][ "is_visible" ] = true;
    $formFieldsUpdate[ "dispatchFeeSum" ][ "is_visible" ] = false;

} else {

    $formFieldsUpdate[ "dispatchFeePercent" ][ "is_visible" ] = false;
    $formFieldsUpdate[ "dispatchFeeSum" ][ "is_visible" ] = true;

}

if ( $requestData->driverType == "operator" ) {

    $formFieldsUpdate[ "consumptionCard" ][ "is_visible" ] = true;
    $formFieldsUpdate[ "insurancePeriod_from" ][ "is_visible" ] = true;
    $formFieldsUpdate[ "insurancePeriod_to" ][ "is_visible" ] = true;
    $formFieldsUpdate[ "dispatchFee" ][ "is_visible" ] = true;
    $formFieldsUpdate[ "usingApp" ][ "is_visible" ] = true;
    $formFieldsUpdate[ "lookBook" ][ "is_visible" ] = true;

} else if ( $requestData->driverType == "driver" ) {

    $formFieldsUpdate[ "insurancePeriod_from" ][ "is_visible" ] = false;
    $formFieldsUpdate[ "insurancePeriod_to" ][ "is_visible" ] = false;
    $formFieldsUpdate[ "dispatchFee" ][ "is_visible" ] = false;
    $formFieldsUpdate[ "usingApp" ][ "is_visible" ] = false;
    $formFieldsUpdate[ "lookBook" ][ "is_visible" ] = false;

}

if ( $requestData->role_id == 31 ) {

    $formFieldsUpdate[ "consumptionCard" ][ "is_visible" ] = true;
    $formFieldsUpdate[ "insurancePeriod_from" ][ "is_visible" ] = true;
    $formFieldsUpdate[ "insurancePeriod_to" ][ "is_visible" ] = true;
    $formFieldsUpdate[ "dispatchFee" ][ "is_visible" ] = true;
    $formFieldsUpdate[ "usingApp" ][ "is_visible" ] = true;
    $formFieldsUpdate[ "lookBook" ][ "is_visible" ] = true;

} else {

    $formFieldsUpdate[ "insurancePeriod_from" ][ "is_visible" ] = false;
    $formFieldsUpdate[ "insurancePeriod_to" ][ "is_visible" ] = false;
    $formFieldsUpdate[ "dispatchFee" ][ "is_visible" ] = false;
    $formFieldsUpdate[ "usingApp" ][ "is_visible" ] = false;
    $formFieldsUpdate[ "lookBook" ][ "is_visible" ] = false;

}

if ( $requestData->role_id == 3 ) {

    $dispatchersSalary = $API->DB->from( "dispatchersSalary" )
        ->limit( 1 )
        ->fetch();


    if ( $dispatchersSalary[ "salaryType" ] == "percent" ) {

        $formFieldsUpdate[ "salaryPercent" ][ "is_visible" ] = true;
        $formFieldsUpdate[ "salarySum" ][ "is_visible" ] = false;

    } else {

        $formFieldsUpdate[ "salaryPercent" ][ "is_visible" ] = false;
        $formFieldsUpdate[ "salarySum" ][ "is_visible" ] = true;

    }

    $formFieldsUpdate[ "period" ][ "value" ] = "month";
    $formFieldsUpdate[ "salarySum" ][ "value" ] = $dispatchersSalary[ "salarySum" ];
    $formFieldsUpdate[ "salaryPercent" ][ "value" ] = $dispatchersSalary[ "salaryPercent" ];
    $formFieldsUpdate[ "salaryType" ][ "value" ] = $dispatchersSalary[ "salaryType" ];

}

if ( $requestData->role_id == 31 ) {

    $dispatchCollection = $API->DB->from( "dispatchCollection" )
        ->limit( 1 )
        ->fetch();

    if ( $dispatchCollection[ "salaryType" ] == "percent" ) {

        $formFieldsUpdate[ "salaryPercent" ][ "is_visible" ] = true;
        $formFieldsUpdate[ "salarySum" ][ "is_visible" ] = false;

    } else {

        $formFieldsUpdate[ "salaryPercent" ][ "is_visible" ] = false;
        $formFieldsUpdate[ "salarySum" ][ "is_visible" ] = true;

    }

    $formFieldsUpdate[ "salarySum" ][ "value" ] = $dispatchCollection[ "salarySum" ];
    $formFieldsUpdate[ "salaryPercent" ][ "value" ] = $dispatchCollection[ "salaryPercent" ];
    $formFieldsUpdate[ "salaryType" ][ "value" ] = $dispatchCollection[ "salaryType" ];

}

if ( $requestData->role_id == 26 ) {

    $amountAdmin = $API->DB->from( "amountAdmin" )
        ->limit( 1 )
        ->fetch();

    $formFieldsUpdate[ "salarySum" ][ "value" ] = $amountAdmin[ "sum" ];
    $formFieldsUpdate[ "salaryType" ][ "value" ] = "fixed";
    $formFieldsUpdate[ "period" ][ "value" ] = $amountAdmin[ "period" ];

}

$API->returnResponse( $formFieldsUpdate );