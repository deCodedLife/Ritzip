<?php

if ( $requestData->type == "semitrack" ) {

    $updatedFields[ "trailer_id" ][ "is_visible" ] = false;

}

if ( $requestData->type == "pickup" ) {

    $updatedFields[ "trailer_id" ][ "is_visible" ] = true;

}

$API->returnResponse( $updatedFields );
