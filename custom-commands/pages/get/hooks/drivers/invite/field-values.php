<?php

if ( $requestData->context->form == "invite" ) {

    function generatePassword007( int $length = 8, string $availableSets = "luds" ): string
    {
        $symbols = [];
        $password = "";
        $str = "";
        if ( strpos( $availableSets, "l") !== false ) {
            $symbols[] = "abcdefghjkmnpqrstuvwxyz";
        }
        if ( strpos( $availableSets, "u") !== false ) {
            $symbols[] = "ABCDEFGHJKMNPQRSTUVWXYZ";
        }
        if ( strpos( $availableSets, "d" ) !== false ) {
            $symbols[] = "23456789";
        }
        if ( strpos( $availableSets, "s") !== false ) {
            $symbols[] = '!@#$%&*?';
        }
        foreach ( $symbols as $symbol ) {
            $password .= $symbol[ array_rand( str_split( $symbol ) ) ];
            $str .= $symbol;
        }
        $str = str_split( $str );
        for ( $i = 0; $i < $length - count( $symbols ); $i++ ) {
            $password .= $str[ array_rand( $str ) ];
        }
        $password = str_shuffle( $password );
        $password = $password . "1Driver";
        return $password;
    }

    $invitePassword = generatePassword007( $length = 8, $availableSets = 'lud' );

    $formFieldValues[ "role_id" ][ "value" ] = 4;
    $formFieldValues[ "first_name" ][ "value" ] = "Заполните поле";
    $formFieldValues[ "last_name" ][ "value" ] = "Заполните поле";
    $formFieldValues[ "password" ][ "value" ] = $invitePassword;
    $formFieldValues[ "invitePassword" ][ "value" ] = $invitePassword;

    $formFieldValues[ "role_id" ][ "is_visible" ] = false;
    $formFieldValues[ "first_name" ][ "is_visible" ] = false;
    $formFieldValues[ "last_name" ][ "is_visible" ] = false;
    $formFieldValues[ "password" ][ "is_visible" ] = false;
    $formFieldValues[ "invitePassword" ][ "is_visible" ] = false;


}






