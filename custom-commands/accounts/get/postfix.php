<?php

$returnAccounts = [];

foreach ( $response[ "data" ] as $account ) {

    $allAccounts = $API->DB->from( "accounts" )
        ->where( "is_active", "Y" );

    $count = 0;

    foreach ( $allAccounts as $allAccount ) {

        if ( $allAccount[ "number" ] == $account[ "number" ] && $account[ "number" ] != "" ) {

            $count++;

        }

    }

    if ( $count > 1 )  $account[ "number" ] = $account[ "number" ] . " ( повторяющийся ) ";

    $returnAccounts[] = $account;

}

$response[ "data" ] = $returnAccounts;