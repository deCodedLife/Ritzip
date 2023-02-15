<?php

/**
 * Формирование ключа чата
 */

$usersId = [ $API::$userDetail->id, $API::$userDetail->author_id ];
asort( $usersId );

$usersId = implode( "", $usersId );

$requestData->chat_key = (int) $usersId;