<?php


switch ( $requestData->binding ) {

    case "client":

        $formFieldsUpdate[ "contact_id" ] = [ "is_visible" => false, "value" => "" ];
        $formFieldsUpdate[ "company_id" ] = [ "is_visible" => false, "value" => "" ];
        $formFieldsUpdate[ "order_id" ] = [ "is_visible" => false, "value" => "" ];
        $formFieldsUpdate[ "car_id" ] = [ "is_visible" => false, "value" => "" ];
        $formFieldsUpdate[ "driver_id" ] = [ "is_visible" => false, "value" => "" ];
        $formFieldsUpdate[ "trailer_id" ] = [ "is_visible" => false, "value" => "" ];
        $formFieldsUpdate[ "expense_id" ] = [ "is_visible" => false, "value" => "" ];
        $formFieldsUpdate[ "client_id" ] = [ "is_visible" => true ];

        break;

    case "contact":

        $formFieldsUpdate[ "client_id" ] = [ "is_visible" => false, "value" => "" ];
        $formFieldsUpdate[ "company_id" ] = [ "is_visible" => false, "value" => "" ];
        $formFieldsUpdate[ "order_id" ] = [ "is_visible" => false, "value" => "" ];
        $formFieldsUpdate[ "expense_id" ] = [ "is_visible" => false, "value" => "" ];
        $formFieldsUpdate[ "car_id" ] = [ "is_visible" => false, "value" => "" ];
        $formFieldsUpdate[ "driver_id" ] = [ "is_visible" => false, "value" => "" ];
        $formFieldsUpdate[ "trailer_id" ] = [ "is_visible" => false, "value" => "" ];
        $formFieldsUpdate[ "contact_id" ] = [ "is_visible" => true ];

        break;

    case "company":

        $formFieldsUpdate[ "client_id" ] = [ "is_visible" => false, "value" => "" ];
        $formFieldsUpdate[ "contact_id" ] = [ "is_visible" => false, "value" => "" ];
        $formFieldsUpdate[ "order_id" ] = [ "is_visible" => false, "value" => "" ];
        $formFieldsUpdate[ "expense_id" ] = [ "is_visible" => false, "value" => "" ];
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
        $formFieldsUpdate[ "expense_id" ] = [ "is_visible" => false, "value" => "" ];
        $formFieldsUpdate[ "trailer_id" ] = [ "is_visible" => false, "value" => "" ];
        $formFieldsUpdate[ "order_id" ] = [ "is_visible" => true ];

        break;

    case "car":

        $formFieldsUpdate[ "client_id" ] = [ "is_visible" => false, "value" => "" ];
        $formFieldsUpdate[ "contact_id" ] = [ "is_visible" => false, "value" => "" ];
        $formFieldsUpdate[ "company_id" ] = [ "is_visible" => false, "value" => "" ];
        $formFieldsUpdate[ "order_id" ] = [ "is_visible" => false, "value" => "" ];
        $formFieldsUpdate[ "driver_id" ] = [ "is_visible" => false, "value" => "" ];
        $formFieldsUpdate[ "expense_id" ] = [ "is_visible" => false, "value" => "" ];
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
        $formFieldsUpdate[ "expense_id" ] = [ "is_visible" => false, "value" => "" ];
        $formFieldsUpdate[ "driver_id" ] = [ "is_visible" => true ];

        break;

    case "trailer":

        $formFieldsUpdate[ "client_id" ] = [ "is_visible" => false, "value" => "" ];
        $formFieldsUpdate[ "contact_id" ] = [ "is_visible" => false, "value" => "" ];
        $formFieldsUpdate[ "company_id" ] = [ "is_visible" => false, "value" => "" ];
        $formFieldsUpdate[ "order_id" ] = [ "is_visible" => false, "value" => "" ];
        $formFieldsUpdate[ "car_id" ] = [ "is_visible" => false, "value" => "" ];
        $formFieldsUpdate[ "driver_id" ] = [ "is_visible" => false, "value" => "" ];
        $formFieldsUpdate[ "expense_id" ] = [ "is_visible" => false, "value" => "" ];
        $formFieldsUpdate[ "trailer_id" ] = [ "is_visible" => true ];

        break;

    case "expense":

        $formFieldsUpdate[ "client_id" ] = [ "is_visible" => false, "value" => "" ];
        $formFieldsUpdate[ "contact_id" ] = [ "is_visible" => false, "value" => "" ];
        $formFieldsUpdate[ "company_id" ] = [ "is_visible" => false, "value" => "" ];
        $formFieldsUpdate[ "order_id" ] = [ "is_visible" => false, "value" => "" ];
        $formFieldsUpdate[ "car_id" ] = [ "is_visible" => false, "value" => "" ];
        $formFieldsUpdate[ "driver_id" ] = [ "is_visible" => false, "value" => "" ];
        $formFieldsUpdate[ "trailer_id" ] = [ "is_visible" => false, "value" => "" ];
        $formFieldsUpdate[ "expense_id" ] = [ "is_visible" => true ];

        break;


} // switch. $requestData->binding

$API->returnResponse($formFieldsUpdate);