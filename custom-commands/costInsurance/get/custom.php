<?php

$costInsurance = $API->DB->from( "costInsurance" )
    ->limit( 1 )
    ->fetch();

$API->returnResponse( $costInsurance );