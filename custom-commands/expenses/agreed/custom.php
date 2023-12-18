<?php

ini_set( "display_errors", 1 );

$expenses = $API->DB->from( "expenses" )
    ->where( "order_id", $requestData->id );

foreach ( $expenses as $expense ) {

    $API->DB->update( "expenses" )
        ->set( [
            "is_agreed" => "Y"
        ] )
        ->where( "id", $expense[ "id" ] )
        ->execute();

}

$API->DB->update( "orders" )
    ->set( [
        "is_agreed" => "Y"
    ] )
    ->where( "id", $requestData->id )
    ->execute();