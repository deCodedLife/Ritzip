<?php

$userDetail = $API->DB->from( "users" )
    ->where( "id", $API::$userDetail->id)
    ->limit( 1 )
    ->fetch();

if ( $userDetail[ "is_allTasks" ] == "N" ) {

    $requestSettings[ "filter" ][ "author_id" ] = $API::$userDetail->id;
    //    if ( $requestData->context->page === "drivers" ) {
//
//        /**
//         * Получение списка задач, где текущий пользователь является
//         */
//        $driverTasks = $API->DB->from( "tasks" )
//            ->where( [
//                "driver_id" => $requestData->employee_id
//            ] );
//
//        /**
//         * Добавление поставленных задач в список
//         */
//        foreach ( $driverTasks as $driverTask )
//            $response[ "data" ][] = (array) $driverTask;
//
//    } // if. $requestData->context->page === "drivers"
//    if ( ( $requestData->context->page == "tasks" ) ) {
//
//        /**
//         * Получение списка задач, где текущий пользователь является Автором
//         */
//        $authorTasks = $API->sendRequest( "tasks", "get", [ "author_id" => (int) $API::$userDetail->id ] );
//
//        /**
//         * Получение списка задач, где текущий пользователь является Автором
//         */
//        $everyoneTasks = $API->DB->from( "tasks" )
//            ->where( [
//                "is_active" => "Y",
//                "is_visible_everyone" => "Y"
//            ] );
//
//        /**
//         * Добавление поставленных задач в список
//         */
//        foreach ( $authorTasks as $authorTask )
//            $response[ "data" ][] = (array) $authorTask;
//
//        /**
//         * Добавление общих задач в список
//         */
//        foreach ( $everyoneTasks as $everyoneTask )
//            $response[ "data" ][] = (array) $everyoneTask;
//
//
//
//        /**
//         * Фильтр дубликатов
//         */
//        $filteredTasks = arrayUniqueByKey( $response[ "data" ], "id" );
//
//
//        /**
//         * Перевод задач в массив
//         */
//
//        $response[ "data" ] = [];
//
//        foreach ( $filteredTasks as $filteredTask )
//            $response[ "data" ][] = (array) $filteredTask;
//
//    } // if. $requestData->context === "list"

}

if ( $userDetail[ "is_allTasks" ] == "Y" && $requestData->is_all == "N" ) {

    $requestSettings[ "filter" ][ "author_id" ] = $API::$userDetail->id;
    //    if ( $requestData->context->page === "drivers" ) {
//
//        /**
//         * Получение списка задач, где текущий пользователь является
//         */
//        $driverTasks = $API->DB->from( "tasks" )
//            ->where( [
//                "driver_id" => $requestData->employee_id
//            ] );
//
//        /**
//         * Добавление поставленных задач в список
//         */
//        foreach ( $driverTasks as $driverTask )
//            $response[ "data" ][] = (array) $driverTask;
//
//    } // if. $requestData->context->page === "drivers"
//    if ( ( $requestData->context->page == "tasks" ) ) {
//
//        /**
//         * Получение списка задач, где текущий пользователь является Автором
//         */
//        $authorTasks = $API->sendRequest( "tasks", "get", [ "author_id" => (int) $API::$userDetail->id ] );
//
//        /**
//         * Получение списка задач, где текущий пользователь является Автором
//         */
//        $everyoneTasks = $API->DB->from( "tasks" )
//            ->where( [
//                "is_active" => "Y",
//                "is_visible_everyone" => "Y"
//            ] );
//
//        /**
//         * Добавление поставленных задач в список
//         */
//        foreach ( $authorTasks as $authorTask )
//            $response[ "data" ][] = (array) $authorTask;
//
//        /**
//         * Добавление общих задач в список
//         */
//        foreach ( $everyoneTasks as $everyoneTask )
//            $response[ "data" ][] = (array) $everyoneTask;
//
//
//
//        /**
//         * Фильтр дубликатов
//         */
//        $filteredTasks = arrayUniqueByKey( $response[ "data" ], "id" );
//
//
//        /**
//         * Перевод задач в массив
//         */
//
//        $response[ "data" ] = [];
//
//        foreach ( $filteredTasks as $filteredTask )
//            $response[ "data" ][] = (array) $filteredTask;
//
//    } // if. $requestData->context === "list"

}

$today = date("Y-m-d");

if ( $requestData->is_today == "Y" ) {

    $requestSettings[ "filter" ][ "created_at >= ?" ] = $today . " 00:00:00";
    $requestSettings[ "filter" ][ "created_at <= ?" ] = $today . " 23:59:59";

    unset( $requestData->is_today );

} // if. $requestData->is_today

if ( $requestData->created_at ) {

    $requestSettings[ "filter" ][ "created_at >= ?" ] = $requestData->created_at . " 00:00:00";
    $requestSettings[ "filter" ][ "created_at <= ?" ] = $requestData->created_at . " 23:59:59";

    unset( $requestData->created_at );

} // if. $requestData->is_today

if ( $requestData->is_future == "Y" ) {

    $requestSettings[ "filter" ][ "deadline >= ?" ] = $today . " 00:00:00";

    unset( $requestData->is_future );

} // if. $requestData->is_future

$todayDatetime = date("Y-m-d");

if ( $requestData->is_overdue == "Y" ) {

    $requestSettings[ "filter" ][ "deadline <= ?" ] = $todayDatetime;

    unset( $requestData->is_overdue );

} // if. $requestData->is_overdue

if ( $requestData->is_assigned == "Y" ) {

    $requestSettings[ "filter" ][ "employee_id" ] = $API::$userDetail->id;

    unset( $requestData->is_assigned );

} // if. $requestData->is_assigned

if ( $requestData->is_observer == "Y" ) {

    $requestSettings[ "filter" ][ "watcher_id" ] = $API::$userDetail->id;

    unset( $requestData->is_observer );

} // if. $requestData->is_observer

if ( $requestData->is_notAssigned == "Y" ) {

    $requestSettings[ "filter" ][ "employee_id" ] = false;

    unset( $requestData->is_notAssigned );

} // if. $requestData->is_observer