<?php

$useApps = $API->DB->from( "useApps" )
    ->where( "id", 1 )
    ->limit( 1 )
    ->fetch();

$API->returnResponse( $useApps,400 );