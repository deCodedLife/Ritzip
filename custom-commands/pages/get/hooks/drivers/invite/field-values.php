<?php

if ( $requestData->context->form == "invite" ) {

    $formFieldValues[ "role_id" ] = [

            "is_visible" => false,
            "value" => 4

    ];

    $formFieldValues[ "first_name" ][ "is_visible" ] = false;
    $formFieldValues[ "last_name" ][ "is_visible" ] = false;
    $formFieldValues[ "password" ][ "is_visible" ] = false;
    $formFieldValues[ "first_name" ][ "value" ] = "Заполните поле";
    $formFieldValues[ "last_name" ][ "value" ] = "Заполните поле";
    $formFieldValues[ "password" ][ "value" ] = "IDEqRe1X4tPQDubh";

}






