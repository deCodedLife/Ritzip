<?php

$API->DB->update( "users" )
    ->set( [
        "is_in_company" => "Y"
    ] )
    ->where( "id", $requestData->contacts_id )
    ->execute();