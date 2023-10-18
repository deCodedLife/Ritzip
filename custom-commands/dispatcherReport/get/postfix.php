<?php

/**
 * Формирование списка
 */

/**
 * Сформированный список заявок
 */
$returnOrders = [];


/**
 * Обход заявок
 */
foreach ( $response[ "data" ] as $order ) {

    if ( $order[ "miles" ] > 0 ) {

        $order[ "milePrice" ] = round( $order[ "cost" ] / $order[ "miles" ], 2 );

    }

    $carDetail = $API->DB->from( "cars" )
        ->where( "id", $order[ "car_id" ] )
        ->limit( 1 )
        ->fetch();

    if ( $carDetail ) {

        $order[ "parkingNumber" ] = $carDetail[ "license_plate_state" ];

    }

    $finesAndBonuses = $API->DB->from( "finesAndBonuses" )
        ->where( "order_id", $order[ "id" ] );

    $finesAndBonusesFormated = [];

    foreach ( $finesAndBonuses as $fineAndBonus ) {

        $cost = "";

        if ( $fineAndBonus[ "bonusOrFine" ] == "bonus" ) {

            $cost = "+" . $fineAndBonus[ "sum" ];

        } else if ( $fineAndBonus[ "bonusOrFine" ] == "fine" ) {

            $cost = "-" . $fineAndBonus[ "sum" ];

        }

        $finesAndBonusesFormated[] = [

            "title" => $cost,
            "value" => $fineAndBonus[ "id" ]

        ];

    }
    $order[ "finesAndBonuses" ] = $finesAndBonusesFormated;


    $returnOrders[] = $order;

} // foreach. $response[ "data" ]


$response[ "data" ] = $returnOrders;