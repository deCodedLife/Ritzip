<?php

$amountAdmin = $API->DB->from( "amountAdmin" )
    ->limit( 1 )
    ->fetch();

$API->returnResponse( $amountAdmin );