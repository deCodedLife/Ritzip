<?php

$formFieldValues[ "responsible_id" ][ "value" ] = $API::$userDetail->id;

$costInsurance = $API->DB->from( "costInsurance" )
    ->limit( 1 )
    ->fetch();

$formFieldValues[ "insuranceAmount" ][ "value" ] = $costInsurance[ "sum" ];
$formFieldValues[ "insurancePeriod" ][ "value" ] = $costInsurance[ "period" ];

$lookBookValues = $API->DB->from( "lookBookValues" )
    ->limit( 1 )
    ->fetch();
$formFieldValues[ "lookBook" ] = $lookBookValues[ "sum" ];


$dispatchCollection = $API->DB->from( "dispatchCollection" )
    ->limit( 1 )
    ->fetch();

$formFieldValues[ "dispatchFeeType" ][ "value" ] = $dispatchCollection[ "salaryType" ];
$formFieldValues[ "dispatchFeeSum" ][ "value" ] = $dispatchCollection[ "salarySum" ];
$formFieldValues[ "dispatchFeePercent" ][ "value" ] = $dispatchCollection[ "salaryPercent" ];

if ( $formFieldValues[ "dispatchFeeType" ] == "percent" ) {

    $formFieldValues[ "dispatchFeePercent" ][ "is_visible" ] = true;
    $formFieldValues[ "dispatchFeeSum" ][ "is_visible" ] = false;

} else {

    $formFieldValues[ "dispatchFeePercent" ][ "is_visible" ] = false;
    $formFieldValues[ "dispatchFeeSum" ][ "is_visible" ] = true;

}