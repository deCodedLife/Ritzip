<?php

$returnOrders = [];

foreach ( $response[ "data" ] as $order ) {

    $dispatcher = $API->DB->from( "users" )
        ->where( "id", $order[ "dispatcher_id" ] )
        ->limit( 1 )
        ->fetch();

    $order[ "dispatcherPhone" ] = $dispatcher[ "phone" ];
    $order[ "dispatcherID" ] = $dispatcher[ "id" ];

    $returnOrders[] = $order;

}

$response[ "data" ] = $returnOrders;