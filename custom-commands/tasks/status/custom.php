<?php

$task = $API->DB->from( "tasks" )
    ->where( "id", $requestData->id )
    ->limit(1)
    ->fetch();

$API->DB->update( "tasks" )
    ->set( [
        "status" => $requestData->status
    ] )
    ->where( "id", $requestData->id )
    ->execute();


if ( $requestData->status == "completed" ) {

    /**
     * Добавление логов
     */

    if ( $task[ "contact_id" ] ) {

        $API->addLog( [
            "table_name" => "contacts",
            "description" => "Завершена задача: " . $task[ "title" ],
            "row_id" => $task[ "contact_id" ]
        ], $requestData );

    } // if. $requestData->contact_id

    if ( $task[ "employee_id" ] ) {

        $API->addLog( [
            "table_name" => "contacts",
            "description" => "Завершена задача: " . $task[ "title" ],
            "row_id" => $task[ "employee_id" ]
        ], $requestData );

    } // if. $requestData->contact_id

    if ( $task[ "company_id" ] ) {

        $API->addLog( [
            "table_name" => "companies",
            "description" => "Завершена задача: " . $task[ "title" ],
            "row_id" => $task[ "company_id" ]
        ], $requestData );

    } // if. $requestData->company_id

    if ( $task[ "order_id" ] ) {

        $API->addLog( [
            "table_name" => "orders",
            "description" => "Завершена задача: " . $task[ "title" ],
            "row_id" => $task[ "order_id" ]
        ], $requestData );

    } // if. $requestData->order_id

    if ( $task[ "car_id" ] ) {

        $API->addLog( [
            "table_name" => "cars",
            "description" => "Завершена задача: " . $task[ "title" ],
            "row_id" => $task[ "car_id" ]
        ], $requestData );

    } // if. $requestData->car_id

    if ( $task[ "driver_id" ] ) {

        $API->addLog( [
            "table_name" => "users",
            "description" => "Завершена задача: " . $task[ "title" ],
            "row_id" => $task[ "driver_id" ]
        ], $requestData );

    } // if. $requestData->driver_id

    if ( $task[ "trailer_id" ] ) {

        $API->addLog( [
            "table_name" => "users",
            "description" => "Завершена задача: " . $task[ "title" ],
            "row_id" => $task[ "trailer_id" ]
        ], $requestData );

    } // if. $requestData->trailer_id

    if ( $task[ "expense_id" ] ) {

        $API->addLog( [
            "table_name" => "users",
            "description" => "Завершена задача: " . $task[ "title" ],
            "row_id" => $task[ "expense_id" ]
        ], $requestData );

    } // if. $requestData->expense_id

}
