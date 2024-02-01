<?php

$is_all = $requestData->is_all;

if ( $requestData->is_all === 'N' ){

    unset( $requestData->is_all );

}

$userDetail = $API->DB->from( "users" )
    ->where( "id", $API::$userDetail->id)
    ->limit( 1 )
    ->fetch();

if ( !$requestData->status  ) {

    $requestSettings[ "filter" ][ "status != ?" ] = "completed";

}

if ( $userDetail[ "is_allTasks" ] == "N" ) {

    $requestSettings[ "filter" ][ "author_id" ] = $API::$userDetail->id;

}

if ( $is_all == "N" ) {

    $requestSettings[ "filter" ][ "is_visible_everyone" ] = "Y";

}

if ( $userDetail[ "is_allTasks" ] == "Y" && $is_all == "N" ) {

    $author_id = $API::$userDetail->id;

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