<?php

$order = $API->DB->from( "orders" )
    ->where( "id", $pageDetail[ "row_id" ] )
    ->limit( 1 )
    ->fetch();

if ( $order[ "is_agreed" ] == "Y" ) {

    $generatedTab[ "components" ][ "buttons" ] = [];

}

