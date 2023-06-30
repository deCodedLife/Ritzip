<?php

/**
 * Вывод поля причины отмены
 */
$formFieldsUpdate = [];

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
