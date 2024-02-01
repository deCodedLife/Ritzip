<?php

/**
 * Обновление полей формы
 */
$formFieldsUpdate = [];

if ( $requestData->role_id == 31 ) {

    $dispatchCollection = $API->DB->from( "dispatchCollection" )
        ->limit( 1 )
        ->fetch();

    $formFieldsUpdate[ "dispatchFeeType" ][ "is_visible" ] = true;
    $formFieldsUpdate[ "dispatchFeeSum" ][ "is_visible" ] = true;
    $formFieldsUpdate[ "dispatchFeePercent" ][ "is_visible" ] = true;
    $formFieldsUpdate[ "insuranceAmount" ][ "is_visible" ] = true;
    $formFieldsUpdate[ "insurancePeriod" ][ "is_visible" ] = true;
    $formFieldsUpdate[ "insurancePeriod_from" ][ "is_visible" ] = true;
    $formFieldsUpdate[ "insurancePeriod_to" ][ "is_visible" ] = true;
    $formFieldsUpdate[ "dispatchFee" ][ "is_visible" ] = true;
    $formFieldsUpdate[ "usingApp" ][ "is_visible" ] = true;
    $formFieldsUpdate[ "lookBook" ][ "is_visible" ] = true;
    
} else {

    $formFieldsUpdate[ "dispatchFeeType" ][ "is_visible" ] = false;
    $formFieldsUpdate[ "dispatchFeeSum" ][ "is_visible" ] = false;
    $formFieldsUpdate[ "dispatchFeePercent" ][ "is_visible" ] = false;
    $formFieldsUpdate[ "insuranceAmount" ][ "is_visible" ] = false;
    $formFieldsUpdate[ "insurancePeriod" ][ "is_visible" ] = false;
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
    $formFieldsUpdate[ "dispatchFeeType" ][ "is_visible" ] = true;

    if ( $dispatchersSalary[ "salaryType" ] == "percent" ) {

        $formFieldsUpdate[ "salaryPercent" ][ "is_visible" ] = true;
        $formFieldsUpdate[ "salarySum" ][ "is_visible" ] = false;

    } else if ( $dispatchersSalary[ "salaryType" ] == "fixed" ) {

        $formFieldsUpdate[ "salaryPercent" ][ "is_visible" ] = false;
        $formFieldsUpdate[ "salarySum" ][ "is_visible" ] = true;

    }

    $formFieldsUpdate[ "salarySum" ][ "value" ] = $dispatchersSalary[ "salarySum" ];
    $formFieldsUpdate[ "salaryPercent" ][ "value" ] = $dispatchersSalary[ "salaryPercent" ];
    $formFieldsUpdate[ "salaryType" ][ "value" ] = $dispatchersSalary[ "salaryType" ];

    if ( $requestData->dispatchFeeType == "percent" ) {

        $formFieldsUpdate[ "dispatchFeePercent" ][ "is_visible" ] = true;
        $formFieldsUpdate[ "dispatchFeeSum" ][ "is_visible" ] = false;

    } else if ( $requestData->dispatchFeeType == "fixed" ) {

        $formFieldsUpdate[ "dispatchFeePercent" ][ "is_visible" ] = false;
        $formFieldsUpdate[ "dispatchFeeSum" ][ "is_visible" ] = true;

    }

}

if ( $requestData->role_id == 26 ) {

    $amountAdmin = $API->DB->from( "amountAdmin" )
        ->limit( 1 )
        ->fetch();

    $formFieldsUpdate[ "salarySum" ][ "value" ] = $amountAdmin[ "sum" ];
    $formFieldsUpdate[ "salaryType" ][ "value" ] = "fixed";
    $formFieldsUpdate[ "period" ][ "value" ] = $amountAdmin[ "period" ];

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

if ( $requestData->salaryType == "percent" ) {

    $formFieldsUpdate[ "salaryPercent" ][ "is_visible" ] = true;
    $formFieldsUpdate[ "salarySum" ][ "is_visible" ] = false;

} else if ( $requestData->salaryType == "fixed" ) {

    $formFieldsUpdate[ "salaryPercent" ][ "is_visible" ] = false;
    $formFieldsUpdate[ "salarySum" ][ "is_visible" ] = true;

}


$API->returnResponse( $formFieldsUpdate );