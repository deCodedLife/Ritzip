<?php

$API->DB->update( "tasks" )
    ->set( [
        "status" => $requestData->status
    ] )
    ->where( "id", $requestData->id )
    ->execute();
