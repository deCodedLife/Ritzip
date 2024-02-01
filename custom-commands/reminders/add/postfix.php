<?php

if ( $requestData->order_id ) {

    $API->addLog( [
        "table_name" => "orders",
        "description" => "Добавлено напоминание: $requestData->title",
        "row_id" => $requestData->order_id
    ], $requestData );

} // if. $requestData->order_id