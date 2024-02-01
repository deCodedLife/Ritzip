<?php

$logDescription = "";

if ( $requestData->responsible_id ) {

    $user = $API->DB->from( "users" )
        ->where( [
            "id" => $requestData->responsible_id
        ] )
        ->limit( 1 )
        ->fetch();

    $logDescription = $logDescription . " Диспетчер изменен на " . $user[ "last_name" ] . "; " ;

}

if ( $requestData->sender_id ) {

    $user = $API->DB->from( "users" )
        ->where( [
            "id" => $requestData->sender_id
        ] )
        ->limit( 1 )
        ->fetch();

    $logDescription = $logDescription . " Отправитель изменен на " . $user[ "last_name" ] . "; " ;

}

if ( $requestData->recipient_id ) {

    $user = $API->DB->from( "users" )
        ->where( [
            "id" => $requestData->recipient_id
        ] )
        ->limit( 1 )
        ->fetch();

    $logDescription = $logDescription . " Получатель изменен на " . $user[ "last_name" ] . "; " ;

}

if ( $requestData->owneroperator_id ) {

    $user = $API->DB->from( "users" )
        ->where( [
            "id" => $requestData->owneroperator_id
        ] )
        ->limit( 1 )
        ->fetch();

    $logDescription = $logDescription . " Owner Operator изменен на " . $user[ "last_name" ] . "; " ;

}

if ( $requestData->driver_id ) {

    $user = $API->DB->from( "users" )
        ->where( [
            "id" => $requestData->driver_id
        ] )
        ->limit( 1 )
        ->fetch();

    $logDescription = $logDescription . " Водитель изменен на " . $user[ "last_name" ] . "; " ;

}