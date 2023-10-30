<?php


if ( $orders_count_from ) {

    $filteredOrders = [];

    foreach ( $response[ "data" ] as $company ) {

        $orders = $API->DB->from( "orders" )
            ->where( "company_id", $company[ "id" ] );

        $count = 0;

        foreach ( $orders as $order ) {

            $count++;

        }

        if ( $orders_count_from <= $count ) {

            $filteredOrders[] = $company;

        }

    }

    /**
     * Запись в выдачу
     */
    $response[ "data" ] = $filteredOrders;

}

if ( $orders_count_to ) {

    $filteredOrders = [];

    foreach ( $response[ "data" ] as $company ) {

        $orders = $API->DB->from( "orders" )
            ->where( "company_id", $company[ "id" ] );

        $count = 0;

        foreach ( $orders as $order ) {

            $count++;

        }

        if ( $orders_count_to >= $count ) {

            $filteredOrders[] = $company;

        }

    }

    /**
     * Запись в выдачу
     */
    $response[ "data" ] = $filteredOrders;

}

if ( $orders_cost_from ) {

    $filteredOrders = [];

    foreach ( $response[ "data" ] as $company ) {

        $orders = $API->DB->from( "orders" )
            ->where( "company_id", $company[ "id" ] );

        $cost = 0;

        foreach ( $orders as $order ) {

            $cost += $order[ "cost" ];

        }

        if ( $orders_cost_from <= $cost ) {

            $filteredOrders[] = $company;

        }

    }

    /**
     * Запись в выдачу
     */
    $response[ "data" ] = $filteredOrders;

}

if ( $orders_cost_to ) {

    $filteredOrders = [];

    foreach ( $response[ "data" ] as $company ) {

        $orders = $API->DB->from( "orders" )
            ->where( "company_id", $company[ "id" ] );

        $cost = 0;

        foreach ( $orders as $order ) {

            $cost += $order[ "cost" ];

        }

        if ( $orders_cost_to >= $cost ) {

            $filteredOrders[] = $company;

        }

    }

    /**
     * Запись в выдачу
     */
    $response[ "data" ] = $filteredOrders;


}