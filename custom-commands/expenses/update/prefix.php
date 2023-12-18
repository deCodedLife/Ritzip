<?php

/**
 * Фильтр по дате
 */

$expense = $API->DB->from( "expenses" )
    ->where( "id", $requestData->id )
    ->limit( 1 )
    ->fetch();

$user = $API->DB->from( "users" )
    ->where( "id", $API::$userDetail->id )
    ->limit( 1 )
    ->fetch();


if ( $expense[ "is_agreed" ] == "Y" && $user[ "role_id" ] != "22" ) {

    $API->returnResponse( "Расход нельзя иземенить, так как он уже подтвержден бухгалтером", 400 );

} // if. $expense[ "is_agreed" ]
