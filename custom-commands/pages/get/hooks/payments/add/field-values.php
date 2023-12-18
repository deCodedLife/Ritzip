<?php

$formFieldValues[ "responsible_id" ] = $API::$userDetail->id;

if ( ( $requestData->context->form == "contactPayments" ) && $requestData->context->row_id ) {

    $formFieldValues[ "object" ] = "contact";
    $formFieldValues[ "contact_id" ] = [

        "value" => $requestData->context->row_id,
        "is_visible" => true,

    ];

}

if ( ( $requestData->context->form == "payments" ) && $requestData->context->row_id ) {

    $formFieldValues[ "account_id" ] = [

        "value" => $requestData->context->row_id,
        "is_visible" => true,

    ];

}

if ( ( $requestData->context->form == "orderPayments" ) && $requestData->context->row_id ) {

    $formFieldValues["object"] = "order";
    $formFieldValues["order_id"] = [

        "value" => $requestData->context->row_id,
        "is_visible" => true,

    ];
}

if ( ( $requestData->context->form == "driverPayments" ) && $requestData->context->row_id ) {

    $formFieldValues["object"] = "driver";
    $formFieldValues["driver_id"] = [

        "value" => $requestData->context->row_id,
        "is_visible" => true,

    ];

}

if ( ( $requestData->context->form == "carPayments" ) && $requestData->context->row_id ) {

    $formFieldValues[ "object" ] = "car";
    $formFieldValues[ "car_id" ] = [

        "value" => $requestData->context->row_id,
        "is_visible" => true,

    ];

}
