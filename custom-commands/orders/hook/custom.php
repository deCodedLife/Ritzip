<?php

/**
 * Вывод поля причины отмены
 */
$formFieldsUpdate = [];

/**
 * Переключение Компания - Клиент
 */
switch ( $requestData->sourceType ) {

    case "sourse_contact":

        $formFieldsUpdate[ "sourse_contact" ] = [
            "is_visible" => true
        ];

        $formFieldsUpdate[ "company_id" ] = [
            "is_visible" => false,
            "value" => ""
        ];

        break;

    case "company":

        $formFieldsUpdate[ "company_id" ] = [
            "is_visible" => true,
        ];

        $formFieldsUpdate[ "sourse_contact" ] = [
            "is_visible" => false,
            "value" => ""
        ];

        break;

} // switch. $requestData->purchaseType

if ( $requestData->car_id ) {

    $driverCar = $API->DB->from( "driver_cars" )
        ->where( "id", $requestData->car_id )
        ->limit( 1 )
        ->fetch();

    $carDetail = $API->DB->from( "cars" )
        ->where( "id", $driverCar[ "car_id" ] )
        ->limit( 1 )
        ->fetch();

    $formFieldsUpdate[ "trailerType" ] = [
        "value" => $carDetail[ "trailerType" ]
    ];

}

$API->returnResponse( $formFieldsUpdate );
