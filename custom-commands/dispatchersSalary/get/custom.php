<?php

$dispatchersSalary = $API->DB->from( "dispatchersSalary" )
    ->limit( 1 )
    ->fetch();

$API->returnResponse( $dispatchersSalary );