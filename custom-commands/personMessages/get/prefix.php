<?php

/**
 * Получение ключа чата
 */

$usersId = [ $API::$userDetail->id, $API::$userDetail->chat_key ];
asort( $usersId );

$usersId = implode( "", $usersId );

$requestData->chat_key = (int) $usersId;