<?php

$formFieldsUpdate = [];

/**
 * Переключение объекта
 */

switch ( $requestData->object ) {

    case "contact":
        
        $formFieldsUpdate[ "car_id" ] = [
            "is_visible" => false,
            "value" => ""
        ];
        $formFieldsUpdate[ "driver_id" ] = [
            "is_visible" => false,
            "value" => ""
        ];
        $formFieldsUpdate[ "order_id" ] = [
            "is_visible" => false,
            "value" => ""
        ];
        $formFieldsUpdate[ "company_id" ] = [
            "is_visible" => false,
            "value" => ""
        ];
        $formFieldsUpdate[ "contact_id" ] = [
            "is_visible" => true
        ];

        break;

    case "car":

        $formFieldsUpdate[ "contact_id" ] = [
            "is_visible" => false,
            "value" => ""
        ];
        $formFieldsUpdate[ "driver_id" ] = [
            "is_visible" => false,
            "value" => ""
        ];
        $formFieldsUpdate[ "order_id" ] = [
            "is_visible" => false,
            "value" => ""
        ];
        $formFieldsUpdate[ "company_id" ] = [
            "is_visible" => false,
            "value" => ""
        ];
        $formFieldsUpdate[ "car_id" ] = [
            "is_visible" => true
        ];

        break;

    case "driver":

        $formFieldsUpdate[ "contact_id" ] = [
            "is_visible" => false,
            "value" => ""
        ];
        $formFieldsUpdate[ "car_id" ] = [
            "is_visible" => false,
            "value" => ""
        ];
        $formFieldsUpdate[ "order_id" ] = [
            "is_visible" => false,
            "value" => ""
        ];
        $formFieldsUpdate[ "company_id" ] = [
            "is_visible" => false,
            "value" => ""
        ];
        $formFieldsUpdate[ "driver_id" ] = [
            "is_visible" => true
        ];

        break;

    case "order":

        $formFieldsUpdate[ "contact_id" ] = [
            "is_visible" => false,
            "value" => ""
        ];
        $formFieldsUpdate[ "car_id" ] = [
            "is_visible" => false,
            "value" => ""
        ];
        $formFieldsUpdate[ "driver_id" ] = [
            "is_visible" => false,
            "value" => ""
        ];
        $formFieldsUpdate[ "company_id" ] = [
            "is_visible" => false,
            "value" => ""
        ];
        $formFieldsUpdate[ "order_id" ] = [
            "is_visible" => true
        ];

        break;

    case "company":

        $formFieldsUpdate[ "contact_id" ] = [
            "is_visible" => false,
            "value" => ""
        ];
        $formFieldsUpdate[ "car_id" ] = [
            "is_visible" => false,
            "value" => ""
        ];
        $formFieldsUpdate[ "driver_id" ] = [
            "is_visible" => false,
            "value" => ""
        ];
        $formFieldsUpdate[ "order_id" ] = [
            "is_visible" => false,
            "value" => ""
        ];
        $formFieldsUpdate[ "company_id" ] = [
            "is_visible" => true
        ];

        break;

} // switch. $requestData->object

$API->returnResponse( $formFieldsUpdate );



