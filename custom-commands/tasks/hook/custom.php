<?php

/**
 * Значения полей
 */
$formFieldsUpdate = [];


/**
 * Переключение - Клиент - Контакт - Компания - Заказ - Транспортное средство - Водитель
 */

switch ( $requestData->binding ) {

    case "client":

        $formFieldsUpdate[ "contact_id" ] = [ "is_visible" => false, "value" => "" ];
        $formFieldsUpdate[ "company_id" ] = [ "is_visible" => false, "value" => "" ];
        $formFieldsUpdate[ "order_id" ] = [ "is_visible" => false, "value" => "" ];
        $formFieldsUpdate[ "car_id" ] = [ "is_visible" => false, "value" => "" ];
        $formFieldsUpdate[ "driver_id" ] = [ "is_visible" => false, "value" => "" ];
        $formFieldsUpdate[ "trailer_id" ] = [ "is_visible" => false, "value" => "" ];
        $formFieldsUpdate[ "client_id" ] = [ "is_visible" => true ];

        break;

    case "contact":

        $formFieldsUpdate[ "client_id" ] = [ "is_visible" => false, "value" => "" ];
        $formFieldsUpdate[ "company_id" ] = [ "is_visible" => false, "value" => "" ];
        $formFieldsUpdate[ "order_id" ] = [ "is_visible" => false, "value" => "" ];
        $formFieldsUpdate[ "car_id" ] = [ "is_visible" => false, "value" => "" ];
        $formFieldsUpdate[ "driver_id" ] = [ "is_visible" => false, "value" => "" ];
        $formFieldsUpdate[ "trailer_id" ] = [ "is_visible" => false, "value" => "" ];
        $formFieldsUpdate[ "contact_id" ] = [ "is_visible" => true ];

        break;

    case "company":

        $formFieldsUpdate[ "client_id" ] = [ "is_visible" => false, "value" => "" ];
        $formFieldsUpdate[ "contact_id" ] = [ "is_visible" => false, "value" => "" ];
        $formFieldsUpdate[ "order_id" ] = [ "is_visible" => false, "value" => "" ];
        $formFieldsUpdate[ "car_id" ] = [ "is_visible" => false, "value" => "" ];
        $formFieldsUpdate[ "driver_id" ] = [ "is_visible" => false, "value" => "" ];
        $formFieldsUpdate[ "trailer_id" ] = [ "is_visible" => false, "value" => "" ];
        $formFieldsUpdate[ "company_id" ] = [ "is_visible" => true ];

        break;

    case "order":

        $formFieldsUpdate[ "client_id" ] = [ "is_visible" => false, "value" => "" ];
        $formFieldsUpdate[ "contact_id" ] = [ "is_visible" => false, "value" => "" ];
        $formFieldsUpdate[ "company_id" ] = [ "is_visible" => false, "value" => "" ];
        $formFieldsUpdate[ "car_id" ] = [ "is_visible" => false, "value" => "" ];
        $formFieldsUpdate[ "driver_id" ] = [ "is_visible" => false, "value" => "" ];
        $formFieldsUpdate[ "trailer_id" ] = [ "is_visible" => false, "value" => "" ];
        $formFieldsUpdate[ "order_id" ] = [ "is_visible" => true ];

        break;

    case "car":

        $formFieldsUpdate[ "client_id" ] = [ "is_visible" => false, "value" => "" ];
        $formFieldsUpdate[ "contact_id" ] = [ "is_visible" => false, "value" => "" ];
        $formFieldsUpdate[ "company_id" ] = [ "is_visible" => false, "value" => "" ];
        $formFieldsUpdate[ "order_id" ] = [ "is_visible" => false, "value" => "" ];
        $formFieldsUpdate[ "driver_id" ] = [ "is_visible" => false, "value" => "" ];
        $formFieldsUpdate[ "trailer_id" ] = [ "is_visible" => false, "value" => "" ];
        $formFieldsUpdate[ "car_id" ] = [ "is_visible" => true ];

        break;

    case "driver":

        $formFieldsUpdate[ "client_id" ] = [ "is_visible" => false, "value" => "" ];
        $formFieldsUpdate[ "contact_id" ] = [ "is_visible" => false, "value" => "" ];
        $formFieldsUpdate[ "company_id" ] = [ "is_visible" => false, "value" => "" ];
        $formFieldsUpdate[ "order_id" ] = [ "is_visible" => false, "value" => "" ];
        $formFieldsUpdate[ "car_id" ] = [ "is_visible" => false, "value" => "" ];
        $formFieldsUpdate[ "trailer_id" ] = [ "is_visible" => false, "value" => "" ];
        $formFieldsUpdate[ "driver_id" ] = [ "is_visible" => true ];

        break;

    case "trailer":

        $formFieldsUpdate[ "client_id" ] = [ "is_visible" => false, "value" => "" ];
        $formFieldsUpdate[ "contact_id" ] = [ "is_visible" => false, "value" => "" ];
        $formFieldsUpdate[ "company_id" ] = [ "is_visible" => false, "value" => "" ];
        $formFieldsUpdate[ "order_id" ] = [ "is_visible" => false, "value" => "" ];
        $formFieldsUpdate[ "car_id" ] = [ "is_visible" => false, "value" => "" ];
        $formFieldsUpdate[ "driver_id" ] = [ "is_visible" => false, "value" => "" ];
        $formFieldsUpdate[ "trailer_id" ] = [ "is_visible" => true ];

        break;


} // switch. $requestData->binding


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


$API->returnResponse( $formFieldsUpdate );
