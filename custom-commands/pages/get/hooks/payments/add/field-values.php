<?php

$formFieldValues[ "responsible_id" ] = $API::$userDetail->id;

if ( ( $requestData->context->form == "contactPayments" ) && $requestData->context->row_id ) {

    $formFieldValues[ "object" ] = "contact";
    $formFieldValues[ "contact_id" ] = [

        "value" => $requestData->context->row_id,
        "is_visible" => true,

    ];

}

if ( ( $requestData->context->form == "companyPayments" ) && $requestData->context->row_id ) {

    $formFieldValues[ "object" ] = "company";
    $formFieldValues[ "company_id" ] = [

        "value" => $requestData->context->row_id,
        "is_visible" => true,

    ];

}

if ( ( $requestData->context->form == "userPayments" ) && $requestData->context->row_id ) {

    $formFieldValues[ "responsible_id" ] = [

        "value" => $requestData->context->row_id,
        "is_visible" => true,

    ];

}

if ( ( $requestData->context->form == "trailerPayments" ) && $requestData->context->row_id ) {

    $formFieldValues["object"] = "trailer";
    $formFieldValues["trailer_id"] = [

        "value" => $requestData->context->row_id,
        "is_visible" => true,

    ];
}

if ( ( $requestData->context->form == "payments" ) && $requestData->context->row_id ) {

    $formFieldValues[ "account_id" ] = [

        "value" => $requestData->context->row_id,
        "is_visible" => true,

    ];


    /**
     * Остаток оплаты
     */

    $accountDetail = $API->DB->from( "accounts" )
        ->where( "id", $requestData->context->row_id )
        ->limit( 1 )
        ->fetch();

    $accountPayments = $API->DB->from( "payments" )
        ->where( "account_id", $requestData->context->row_id );



    /**
     * Текущая сумма оплаты Счета
     */

    $accountPaymentSum = 0;

    foreach ( $accountPayments as $accountPayment )
        $accountPaymentSum += $accountPayment[ "sum" ];


    $sumFieldValue = $accountDetail[ "sum" ] - $accountPaymentSum;
    if ( $sumFieldValue < 0 ) $sumFieldValue = 0;

    $formFieldValues[ "sum" ] = [

        "value" => $sumFieldValue,
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