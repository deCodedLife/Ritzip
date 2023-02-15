<?php

if ( $requestData->context === "list" ) {

    /**
     * Получение списка задач, где текущий пользователь является Автором
     */
    $authorTasks = $API->sendRequest( "tasks", "get", [ "author_id" => (int) $API::$userDetail->id ] );


    /**
     * Добавление поставленных задач в список
     */
    foreach ( $authorTasks as $authorTask ) {

        $response[ "data" ][] = $authorTask;

    } // foreach. $authorTasks

} // if. $requestData->context === "list"