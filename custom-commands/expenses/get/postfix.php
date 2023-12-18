<?php

function format_phone_number( $number ) {

    $cleaned_number = preg_replace( '/\D/', '', $number );
    $formatted_number = "(" . substr( $cleaned_number, 0, 3).") ".substr( $cleaned_number, 3, 3 )."-".substr( $cleaned_number, 6 );
    return $formatted_number;

}

$expenses = [];

foreach ( $response[ "data" ] as $expense ) {

    $user = $API->DB->from( "users" )
        ->where( "id", $expense[ "author_id" ][ "value" ] )
        ->limit( 1 )
        ->fetch();

    $role = $API->DB->from( "roles" )
        ->where( "id", $user[ "role_id" ] )
        ->limit( 1 )
        ->fetch();

    if ( $user[ "phone" ] ) {

        $user[ "phone" ] = ", " . format_phone_number( $user[ "phone" ] );

    }

    if ( $role ) {

        $role[ "title" ] = ", " . $role[ "title" ];

    }

    $expense[ "author_id" ][ "title" ] = $user[ "last_name" ] . " " . $user[ "first_name" ] .  $role[ "title" ] . $user[ "phone" ];

    $expenses[] = $expense;

}

$response[ "data" ] = $expenses;