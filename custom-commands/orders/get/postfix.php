<?php

/**
 * Формирование заголовков и описания заявок для воронки
 */
if ( $requestData->context->block === "funnel" ) {

    /**
     * Сформированный список заявок
     */
    $returnOrders = [];


    /**
     * Обход заявок
     */
    foreach ( $response[ "data" ] as $order ) {

        $returnOrders[] = [
            "id" => $order[ "id" ],
            "title" => $order[ "origin_city" ] . " -> " . $order[ "destination_city" ],
            "description" => $order[ "created_at" ],
            "status_id" => $order[ "status_id" ]
        ];

    } // foreach. $response[ "data" ]


    $response[ "data" ] = $returnOrders;

} // if. $requestData->context->block === "funnel"