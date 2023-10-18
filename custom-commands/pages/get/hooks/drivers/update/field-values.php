<?php
$formFieldValues[ "role_id" ] = [ "is_visible" => false ];

if ( $pageDetail[ "row_detail" ][ "driverType" ]->value == "operator" ) {

    $formFieldValues[ "insuranceAmount" ][ "is_visible" ] = true;
    $formFieldValues[ "insurancePeriod_from" ][ "is_visible" ] = true;
    $formFieldValues[ "insurancePeriod_to" ][ "is_visible" ] = true;
    $formFieldValues[ "dispatchFee" ][ "is_visible" ] = true;
    $formFieldValues[ "usingApp" ][ "is_visible" ] = true;
    $formFieldValues[ "lookBook" ][ "is_visible" ] = true;

}



