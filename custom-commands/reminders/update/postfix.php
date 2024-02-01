<?php

$reminerDetail = $API->DB->from( "reminders" )
    ->where( "id", $requestData->id )
    ->limit( 1 )
    ->fetch();

if ( $reminerDetail[ "order_id" ] ) {

    $API->addLog( [
        "table_name" => "orders",
        "description" => "Изменено напоминание: " . $reminerDetail[ "title" ],
        "row_id" => $reminerDetail[ "order_id" ]
    ], $requestData );

} // if. $requestData->order_id