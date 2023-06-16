<?php

/**
 * Вывод списка пользователей в Чате
 */
if ( $requestData->context->block === "chat" ) {

    /**
     * Сформированный список пользователей
     */
    $returnUsers = [];


    /**
     * Формирование списка пользователей
     */
    foreach ( $response[ "data" ] as $user )
        $returnUsers[] = [
            "id" => $user[ "id" ],
            "title" => $user[ "last_name" ] . " " . $user[ "first_name" ] . " " . $user[ "patronymic" ],
            "role_id" => $user[ "role_id" ]
        ];


    /**
     * Обновление списка пользователей
     */
    $response[ "data" ] = $returnUsers;

} // if. $requestData->context->block === "chat"