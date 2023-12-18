<?php

$lookBookValues = $API->DB->from( "lookBookValues" )
    ->limit( 1 )
    ->fetch();

$API->returnResponse( $lookBookValues );