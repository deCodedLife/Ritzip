<?php

/**
 * Автоподстановка роли
 */

$user = $API->DB->from( "users" )
    ->where( "id", $pageDetail[ "row_id" ])
    ->limit( 1 )
    ->fetch();

if ( $user[ "role_id" ] == "4" ) {

    if ( $user[ "driverType" ] == "operator" ) {

        $formFieldValues[ "consumptionCard" ][ "is_visible" ] = true;
        $formFieldValues[ "insurancePeriod_from" ][ "is_visible" ] = true;
        $formFieldValues[ "insurancePeriod_to" ][ "is_visible" ] = true;
        $formFieldValues[ "dispatchFee" ][ "is_visible" ] = true;
        $formFieldValues[ "usingApp" ][ "is_visible" ] = true;
        $formFieldValues[ "lookBook" ][ "is_visible" ] = true;

    } else if ( $user[ "driverType" ] == "driver" ) {

        $formFieldValues[ "consumptionCard" ][ "is_visible" ] = false;
        $formFieldValues[ "insurancePeriod_from" ][ "is_visible" ] = false;
        $formFieldValues[ "insurancePeriod_to" ][ "is_visible" ] = false;
        $formFieldValues[ "dispatchFee" ][ "is_visible" ] = false;
        $formFieldValues[ "usingApp" ][ "is_visible" ] = false;
        $formFieldValues[ "lookBook" ][ "is_visible" ] = false;

    }

}


if ( $user[ "role_id" ] == "31" ) {

    $formFieldValues[ "consumptionCard" ][ "is_visible" ] = true;
    $formFieldValues[ "insurancePeriod_from" ][ "is_visible" ] = true;
    $formFieldValues[ "insurancePeriod_to" ][ "is_visible" ] = true;
    $formFieldValues[ "usingApp" ][ "is_visible" ] = true;
    $formFieldValues[ "lookBook" ][ "is_visible" ] = true;
    $formFieldValues[ "includingGasoline" ][ "is_visible" ] = true;

} else {

    $formFieldValues[ "consumptionCard" ][ "is_visible" ] = false;
    $formFieldValues[ "insurancePeriod_from" ][ "is_visible" ] = false;
    $formFieldValues[ "insurancePeriod_to" ][ "is_visible" ] = false;
    $formFieldValues[ "usingApp" ][ "is_visible" ] = false;
    $formFieldValues[ "lookBook" ][ "is_visible" ] = false;
    $formFieldValues[ "includingGasoline" ][ "is_visible" ] = false;

}

if ( $user[ "salaryType" ] == "percent" ) {

    $formFieldValues[ "salaryPercent" ][ "is_visible" ] = true;
    $formFieldValues[ "salarySum" ][ "is_visible" ] = false;

} else if ( $user[ "salaryType" ] == "fixed" ) {

    $formFieldValues[ "salaryPercent" ][ "is_visible" ] = false;
    $formFieldValues[ "salarySum" ][ "is_visible" ] = true;

}

if ( $user[ "role_id" ] != "3" ) {

    $formFieldValues[ "dispatchFeeType" ][ "is_visible" ] = false;
    $formFieldValues[ "dispatchFeePercent" ][ "is_visible" ] = false;
    $formFieldValues[ "dispatchFeeSum" ][ "is_visible" ] = false;

} else {

    $formFieldValues[ "dispatchFeeType" ][ "is_visible" ] = true;
    if ( $user[ "dispatchFeeType" ] == "percent" ) {

        $formFieldValues[ "dispatchFeePercent" ][ "is_visible" ] = true;
        $formFieldValues[ "dispatchFeeSum" ][ "is_visible" ] = false;

    } else if ( $user[ "dispatchFeeType" ] == "fixed" ) {

        $formFieldValues[ "dispatchFeePercent" ][ "is_visible" ] = false;
        $formFieldValues[ "dispatchFeeSum" ][ "is_visible" ] = true;

    }

}

