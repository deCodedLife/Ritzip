<?php
/**
 * @file
 * Хуки на Закупку
 */
$formFieldsUpdate = [];

/**
 * Вывод поля причины отмены
 */
$formFieldsUpdate = [];

if ( !empty ( $requestData->reason_id ) ) {

    $formFieldsUpdate[ "reason_id" ] = [
        "is_visible" => true
    ];

}

/**
 * Переключение Компания - Клиент
 */
switch ( $requestData->sourceType ) {

    case "client":

        $formFieldsUpdate[ "client_id" ] = [
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

        $formFieldsUpdate[ "client_id" ] = [
            "is_visible" => false,
            "value" => ""
        ];

        break;

} // switch. $requestData->purchaseType

$API->returnResponse( $formFieldsUpdate );
