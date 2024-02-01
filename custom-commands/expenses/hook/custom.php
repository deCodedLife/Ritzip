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
        $formFieldsUpdate[ "repeat_days" ][ "value" ] = 7;
        break;

    case "two_weeks":
        $formFieldsUpdate[ "repeat_days" ][ "value" ] = 14;
        break;

    case "month":
        $formFieldsUpdate[ "repeat_days" ][ "value" ] = 30;
        break;

    case "three_month":
        $formFieldsUpdate[ "repeat_days" ][ "value" ] = 90;
        break;

    case "half_year":
        $formFieldsUpdate[ "repeat_days" ][ "value" ] = 180;
        break;

    case "year":
        $formFieldsUpdate[ "repeat_days" ][ "value" ] = 360;
        break;

} // switch. $requestData->repeat_templates


switch ( $requestData->binding ) {

    case "company":

        $formFieldsUpdate[ "contact_id" ] = [ "is_visible" => false, "value" => "" ];
        $formFieldsUpdate[ "order_id" ] = [ "is_visible" => false, "value" => "" ];
        $formFieldsUpdate[ "car_id" ] = [ "is_visible" => false, "value" => "" ];
        $formFieldsUpdate[ "driver_id" ] = [ "is_visible" => false, "value" => "" ];
        $formFieldsUpdate[ "trailer_id" ] = [ "is_visible" => false, "value" => "" ];
        $formFieldsUpdate[ "company_id" ] = [ "is_visible" => true ];
        $formFieldsUpdate[ "dispatcher_id" ] = [ "is_visible" => false, "value" => "" ];
        
        break;

    case "order":

        $formFieldsUpdate[ "contact_id" ] = [ "is_visible" => false, "value" => "" ];
        $formFieldsUpdate[ "company_id" ] = [ "is_visible" => false, "value" => "" ];
        $formFieldsUpdate[ "car_id" ] = [ "is_visible" => false, "value" => "" ];
        $formFieldsUpdate[ "driver_id" ] = [ "is_visible" => false, "value" => "" ];
        $formFieldsUpdate[ "trailer_id" ] = [ "is_visible" => false, "value" => "" ];
        $formFieldsUpdate[ "order_id" ] = [ "is_visible" => true ];
        $formFieldsUpdate[ "dispatcher_id" ] = [ "is_visible" => false, "value" => "" ];

        break;

    case "car":

        $formFieldsUpdate[ "contact_id" ] = [ "is_visible" => false, "value" => "" ];
        $formFieldsUpdate[ "company_id" ] = [ "is_visible" => false, "value" => "" ];
        $formFieldsUpdate[ "order_id" ] = [ "is_visible" => false, "value" => "" ];
        $formFieldsUpdate[ "driver_id" ] = [ "is_visible" => false, "value" => "" ];
        $formFieldsUpdate[ "trailer_id" ] = [ "is_visible" => false, "value" => "" ];
        $formFieldsUpdate[ "car_id" ] = [ "is_visible" => true ];
        $formFieldsUpdate[ "dispatcher_id" ] = [ "is_visible" => false, "value" => "" ];

        break;

    case "driver":

        $formFieldsUpdate[ "contact_id" ] = [ "is_visible" => false, "value" => "" ];
        $formFieldsUpdate[ "company_id" ] = [ "is_visible" => false, "value" => "" ];
        $formFieldsUpdate[ "order_id" ] = [ "is_visible" => false, "value" => "" ];
        $formFieldsUpdate[ "car_id" ] = [ "is_visible" => false, "value" => "" ];
        $formFieldsUpdate[ "trailer_id" ] = [ "is_visible" => false, "value" => "" ];
        $formFieldsUpdate[ "driver_id" ] = [ "is_visible" => true ];
        $formFieldsUpdate[ "dispatcher_id" ] = [ "is_visible" => false, "value" => "" ];

        break;

    case "trailer":

        $formFieldsUpdate[ "contact_id" ] = [ "is_visible" => false, "value" => "" ];
        $formFieldsUpdate[ "company_id" ] = [ "is_visible" => false, "value" => "" ];
        $formFieldsUpdate[ "order_id" ] = [ "is_visible" => false, "value" => "" ];
        $formFieldsUpdate[ "car_id" ] = [ "is_visible" => false, "value" => "" ];
        $formFieldsUpdate[ "driver_id" ] = [ "is_visible" => false, "value" => "" ];
        $formFieldsUpdate[ "trailer_id" ] = [ "is_visible" => true ];
        $formFieldsUpdate[ "dispatcher_id" ] = [ "is_visible" => false, "value" => "" ];

        break;

    case "dispatchers":

        $formFieldsUpdate[ "contact_id" ] = [ "is_visible" => false, "value" => "" ];
        $formFieldsUpdate[ "company_id" ] = [ "is_visible" => false, "value" => "" ];
        $formFieldsUpdate[ "order_id" ] = [ "is_visible" => false, "value" => "" ];
        $formFieldsUpdate[ "car_id" ] = [ "is_visible" => false, "value" => "" ];
        $formFieldsUpdate[ "driver_id" ] = [ "is_visible" => false, "value" => "" ];
        $formFieldsUpdate[ "trailer_id" ] = [ "is_visible" => true ];
        $formFieldsUpdate[ "dispatcher_id" ] = [ "is_visible" => true ];

        break;



} // switch. $requestData->binding




$API->returnResponse( $formFieldsUpdate );