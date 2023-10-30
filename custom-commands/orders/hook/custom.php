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

if ( $requestData->trailer_id ) {

    $trailerDetail = $API->DB->from( "trailers" )
        ->where( "id", $requestData->trailer_id )
        ->limit( 1 )
        ->fetch();

    $formFieldsUpdate[ "trailerType" ] = [
        "value" => $trailerDetail[ "trailerType" ]
    ];
    $formFieldsUpdate[ "placeCount" ] = [
        "value" => $trailerDetail[ "positionCount" ]
    ];

}

if ( $requestData->vehicles_id ) {

    $formFieldsUpdate[ "placeOccupied" ] = [
        "value" => count($requestData->vehicles_id)
    ];


}

$API->returnResponse( $formFieldsUpdate );
