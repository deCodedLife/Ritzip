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
            "sum" => $requestData->sum,
        ] )
        ->execute();

}