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

    $carDetail = $API->DB->from( "cars" )
        ->where( "id", $order[ "car_id" ][ "title" ] )
        ->limit( 1 )
        ->fetch();


    if ( $carDetail ) {

        $order[ "license_plate_state" ] = $carDetail[ "license_plate_state" ];

    } else {

        $order[ "license_plate_state" ] = " ";

    }

    if ( $order[ "cost" ] != 0 && $carDetail[ "plannedRevenue" ] != 0 ) {

        $order[ "percentagePlan" ] = ( $order[ "cost" ] / $carDetail[ "plannedRevenue" ] ) * 100;

    } else {

        $order[ "percentagePlan" ] = "0";

    }
    
    $returnOrders[] = $order;

} // foreach. $response[ "data" ]


$response[ "data" ] = $returnOrders;

if ( $limit ) {

    if ( $sort_by == "percentagePlan" ) {

        if ( $sort_order == "desc" ) $response[ "data" ] = array_values( array_sort( $response[ "data" ], "percentagePlan", SORT_DESC ) );
        if ( $sort_order == "asc" ) $response[ "data" ] = array_values( array_sort( $response[ "data" ], "percentagePlan", SORT_ASC ) );

    }

    if ( $sort_by == "license_plate_state" ) {

        if ( $sort_order == "desc" ) $response[ "data" ] = array_values( array_sort( $response[ "data" ], "license_plate_state", SORT_DESC ) );
        if ( $sort_order == "asc" ) $response[ "data" ] = array_values( array_sort( $response[ "data" ], "license_plate_state", SORT_ASC ) );

    }

    $response[ "data" ] = array_slice($response[ "data" ], $limit * $requestData->page - $limit, $limit);

}