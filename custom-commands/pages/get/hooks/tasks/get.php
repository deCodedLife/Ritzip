<?php
$userDetail = $API->DB->from( "users" )
    ->where( "id", $API::$userDetail->id)
    ->limit( 1 )
    ->fetch();

if ( $userDetail[ "is_allTasks" ] == "N" )
    unset( $pageScheme[ "structure" ][ 1 ][ "components" ][ "filters" ][ 9 ] );

