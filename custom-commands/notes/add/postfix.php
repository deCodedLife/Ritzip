<?php

if ( $requestData->order_id ) $API->addLog( [
    "table_name" => "orders",
    "description" => "Добавлено примечание: " . $requestData->title,
    "row_id" => $requestData->order_id
], $requestData );