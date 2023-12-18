<?php

/**
 * Значения полей
 */
$updatedFields = [];

/**
 * Повторять каждые
 */

switch ( $requestData->repeat_templates ) {

    case "week":
        $updatedFields[ "repeat_days" ][ "value" ] = 7;
        break;

    case "two_weeks":
        $updatedFields[ "repeat_days" ][ "value" ] = 14;
        break;

    case "month":
        $updatedFields[ "repeat_days" ][ "value" ] = 30;
        break;

    case "three_month":
        $updatedFields[ "repeat_days" ][ "value" ] = 90;
        break;

    case "half_year":
        $updatedFields[ "repeat_days" ][ "value" ] = 180;
        break;

    case "year":
        $updatedFields[ "repeat_days" ][ "value" ] = 360;
        break;

} // switch. $requestData->repeat_templates


///**
// * Связки
// */
//
//$linkedFields = [ "contact_id", "trailer_id", "company_id", "car_id", "driver_id", "order_id" ];
//$disabledFields = [];
//
//foreach ( $linkedFields as $linkedFieldKey => $linkedField )
//    if ( !$requestData->{$linkedField} || ( count( $disabledFields ) != $linkedFieldKey ) )
//        $disabledFields[] = $linkedField;
//
//if ( count( $linkedFields ) > count( $disabledFields ) )
//    foreach ( $disabledFields as $disabledField )
//        $updatedFields[ $disabledField ][ "value" ] = null;


$API->returnResponse( $updatedFields );