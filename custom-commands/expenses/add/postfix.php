<?php

$automationRules = $API->DB->from( "automationRules" )
    ->limit( 1 )
    ->fetch();


if ( $automationRules[ "ex_payment_with_status_not_paid" ] == "Y" ) {

    $API->DB->insertInto( "payments" )
        ->values( [
            "car_id" => $requestData->car_id,
            "driver_id" => $requestData->driver_id,
            "author_id" => $API::$userDetail->id,
            "status_id" => 14,
            "sum" => $requestData->cost,
        ] )
        ->execute();

}

if ( $requestData->status_id == 3 ) {

    $API->DB->insertInto( "accounts" )
        ->values( [
            "status" => "paid",
            "title" => $requestData->title,
            "expense_id" => $insertId,
            "number" => microtime(true),
            "sum" => $requestData->cost,
        ] )
        ->execute();

}

if ( $requestData->order_id ) {

    $API->addLog( [
        "table_name" => "orders",
        "description" => "Добавлен расход: " . $requestData->title,
        "row_id" => $insertId
    ], $requestData );

}