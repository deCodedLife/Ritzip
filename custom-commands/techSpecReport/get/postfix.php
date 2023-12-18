<?php

/**
 * Формирование списка
 */

/**
 * Сформированный список заявок
 */
$returnOrders = [];

/**
 * Функция сортировки
 */
function array_sort ( $array, $on, $order=SORT_ASC )
{
    $new_array = array();
    $sortable_array = array();

    if (count($array) > 0) {
        foreach ($array as $k => $v) {
            if (is_array($v)) {
                foreach ($v as $k2 => $v2) {
                    if ($k2 == $on) {
                        $sortable_array[$k] = $v2;
                    }
                }
            } else {
                $sortable_array[$k] = $v;
            }
        }

        switch ($order) {
            case SORT_ASC:
                asort($sortable_array);
                break;
            case SORT_DESC:
                arsort($sortable_array);
                break;
        }

        foreach ($sortable_array as $k => $v) {
            $new_array[$k] = $array[$k];
        }
    }

    return $new_array;
}

/**
 * Обход заявок
 */
foreach ( $response[ "data" ] as $order ) {

    if ( $order[ "miles" ] > 0 ) {

        $order[ "milePrice" ] = round( $order[ "cost" ] / $order[ "miles" ], 2 );

    }

    $carDetail = $API->DB->from( "cars" )
        ->where( "id", $order[ "car_id" ][ "title" ] )
        ->limit( 1 )
        ->fetch();

    if ( $carDetail ) {

        $order[ "parkingNumber" ] = $carDetail[ "license_plate_state" ];

    } else {

        $order[ "parkingNumber" ] = "0";

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

    if ( !$order[ "milePrice" ] ) {

        $order[ "milePrice" ] = "0";

    }

    if ( !$order[ "dispatcherPercent" ] ) {

        $order[ "dispatcherPercent" ] = "0";

    }

    $order[ "miles" ] = number_format($order[ "miles" ], 0, '', ' ');


    $returnOrders[] = $order;

} // foreach. $response[ "data" ]


$response[ "data" ] = $returnOrders;

if ( $limit ) {

    if ( $sort_by == "tachometer" ) {

        if ( $sort_order == "desc" ) $response[ "data" ] = array_values( array_sort( $response[ "data" ], "tachometer", SORT_DESC ) );
        if ( $sort_order == "asc" ) $response[ "data" ] = array_values( array_sort( $response[ "data" ], "tachometer", SORT_ASC ) );

    }


    if ( $sort_by == "dispatcherPercent" ) {

        if ( $sort_order == "desc" ) $response[ "data" ] = array_values( array_sort( $response[ "data" ], "dispatcherPercent", SORT_DESC ) );
        if ( $sort_order == "asc" ) $response[ "data" ] = array_values( array_sort( $response[ "data" ], "dispatcherPercent", SORT_ASC ) );

    }


    if ( $sort_by == "parkingNumber" ) {

        if ( $sort_order == "desc" ) $response[ "data" ] = array_values( array_sort( $response[ "data" ], "parkingNumber", SORT_DESC ) );
        if ( $sort_order == "asc" ) $response[ "data" ] = array_values( array_sort( $response[ "data" ], "parkingNumber", SORT_ASC ) );

    }


    if ( $sort_by == "milePrice" ) {

        if ( $sort_order == "desc" ) $response[ "data" ] = array_values( array_sort( $response[ "data" ], "milePrice", SORT_DESC ) );
        if ( $sort_order == "asc" ) $response[ "data" ] = array_values( array_sort( $response[ "data" ], "milePrice", SORT_ASC ) );

    }

    $response[ "detail" ] = [

        "pages_count" => ceil(count($response[ "data" ]) / $limit ),
        "rows_count" => count($response[ "data" ])

    ];

    $response[ "data" ] = array_slice($response[ "data" ], $limit * $requestData->page - $limit, $limit);

}