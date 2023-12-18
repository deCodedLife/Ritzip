<?php

$dispatchCollection = $API->DB->from( "dispatchCollection" )
    ->limit( 1 )
    ->fetch();

$API->returnResponse( $dispatchCollection );