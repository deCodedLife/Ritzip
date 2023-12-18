<?php

$automationRules = $API->DB->from( "automationRules" )
    ->limit( 1 )
    ->fetch();


if ( $automationRules[ "fab_payment_with_status_not_paid" ] == "Y" ) {

    $API->DB->insertInto( "payments" )
        ->values( [
            "driver_id" => $requestData->driver_id,
            "author_id" => $API::$userDetail->id,
            "status_id" => 14,
        ] )
        ->execute();

}