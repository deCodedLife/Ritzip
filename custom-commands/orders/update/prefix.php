<?php

/**
 * Сохранение истории изменения статуса заявки
 */

$orderDetail = $API->DB->from( "orders" )
    ->where( [
        "id" => $requestData->id
    ] )
    ->limit( 1 )
    ->fetch();

$API->DB->insertInto( "ordersHistory" )
    ->values( [
        "order_id" => $requestData->id,
        "from_status_id" => $orderDetail[ "status_id" ],
        "to_status_id" => $requestData->status_id,
    ] )
    ->execute();