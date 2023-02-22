<?php

/**
 * Получение автора
 */
$requestData->author_id = (int) $API::$userDetail->id;


/**
 * Формирование ключа чата
 */

$usersId = [ $API::$userDetail->id, $requestData->chat_key ];
asort( $usersId );

$usersId = implode( "", $usersId );

$requestData->chat_key = (int) $usersId;