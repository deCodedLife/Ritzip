<?php

$automationRules = $API->DB->from( "automationRules" )
    ->limit( 1 )
    ->fetch();

if ( $automationRules[ "expense_per_dispatcher" ] == "Y" ) {

    $API->DB->insertInto( "expenses" )
        ->values( [
            "title" => "Расход на услуги диспетчера",
            "order_id" => $requestData->id,
            "dispatchers_id" => $requestData->dispatchers_id,
            "author_id" => $API::$userDetail->id,
            "category_id" => 9,
        ] )
        ->execute();

    if ( $automationRules[ "ex_payment_with_status_not_paid" ] == "Y" ) {

        $API->DB->insertInto( "payments" )
            ->values( [
                "car_id" => $requestData->car_id,
                "driver_id" => $requestData->driver_id,
                "author_id" => $API::$userDetail->id,
                "status_id" => 14,
            ] )
            ->execute();

    }

}

if ( $requestData->owneroperator_id && $requestData->paymentType_id == 1 ) {

    if ( $automationRules[ "owner_order_cash_expense_automatically_generated" ] == "Y" ) {

        $API->DB->insertInto( "expenses" )
            ->values( [
                "title" => "У Owner заказ с оплатой типа- Наличные",
                "order_id" => $requestData->id,
                "author_id" => $API::$userDetail->id,
            ] )
            ->execute();

    }

}

if ( $automationRules[ "expense_per_driver" ] == "Y" ) {

    $API->DB->insertInto( "expenses" )
        ->values( [
            "title" => "Расход ЗП водителя",
            "order_id" => $requestData->id,
            "driver_id" => $requestData->driver_id,
            "author_id" => $API::$userDetail->id,
            "category_id" => 9,
        ] )
        ->execute();

    if ( $automationRules[ "ex_payment_with_status_not_paid" ] == "Y" ) {

        $API->DB->insertInto( "payments" )
            ->values( [
                "car_id" => $requestData->car_id,
                "driver_id" => $requestData->driver_id,
                "author_id" => $API::$userDetail->id,
                "status_id" => 14,
            ] )
            ->execute();

    }

}

$API->DB->insertInto( "accounts" )
    ->values( [
        "status" => "notPaid",
        "binding" => "order",
        "employee_id" => $requestData->responsible_id,
        "order_id" => $insertId,
        "number" => microtime(true) . " (Автоматический)",
        "sum" => $requestData->cost
    ] )
    ->execute();


$API->DB->update( "vehicles" )
        ->set( [
            "is_in_orders" => "Y"
        ] )
        ->where( "id", $requestData->vehicles_id )
        ->execute();


if ( $requestData->sender_id ) {

    $API->DB->update( "users" )
        ->set( "is_sender", "Y"  )
        ->where( "id", $requestData->sender_id )
        ->execute();

}


if ( $requestData->source_id ) {

    $API->DB->update( "users" )
        ->set( "is_source", "Y"  )
        ->where( "id", $requestData->source_id )
        ->execute();

}


if ( $requestData->payer_contact_id ) {

    $API->DB->update( "users" )
        ->set( "is_payer", "Y"  )
        ->where( "id", $requestData->payer_contact_id )
        ->execute();

}


if ( $requestData->recipient_id  ) {

    $API->DB->update( "users" )
        ->set( "is_recipient", "Y" )
        ->where( "id", $requestData->recipient_id )
        ->execute();

}
