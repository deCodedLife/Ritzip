<?php

/**
 * Формирование списка
 */

/**
 * Сформированный список заявок
 */
$returnUsers = [];

/**
 * Обход заявок
 */
foreach ( $response[ "data" ] as $user ) {

    $query = "SELECT * FROM orders WHERE responsible_id = " . $user[ 'id' ] . " OR driver_id = " . $user[ 'id' ] . " OR dispatcher_id = " . $user[ 'id' ] . " OR owneroperator_id = " . $user[ 'id' ] . " OR sender_id = " . $user[ 'id' ] . " OR recipient_id = " . $user[ 'id' ] . " AND created_at >= " . "'" . $requestData->created_at_from . "'" .  " AND created_at <= "  .  "'" . $requestData->created_at_to  . "'";

    $orders = mysqli_query(
        $API->DB_connection,
        $query
    );
    $count = 0;
    $paySum = 0;

    foreach ( $orders as $order ) {

        $count++;

        $status = $API->DB->from( "orderStatuses" )
            ->where( "id", $order[ "status_id" ] )
            ->limit( 1 )
            ->fetch();

        $user[ "orders" ][] = [

            "title" => $order[ "id" ] . " - " . $status[ "title" ],
            "value" => $order[ "id" ]

        ];

        $user[ "miles" ] = $user[ "miles" ] + $order[ "miles" ];
        $user[ "plannedRevenue" ] = $user[ "plannedRevenue" ] + $order[ "plannedRevenue" ];

        if ( $order[ "pay_status" ] == 3 ) {

            $paySum = $paySum + $order[ "plannedRevenue" ];

        }

    }

    if ( $user[ "plannedRevenue" ] != 0 ) {

        $user[ "planPercent" ] = ( $paySum / $user[ "plannedRevenue" ] ) * 100;

    }

    $user[ "planPercent" ] = round($user[ "planPercent" ]);
    $user[ "countOrder" ] = $count;

    $returnUsers[] = $user;

} // foreach. $response[ "data" ]


$response[ "data" ] = $returnUsers;