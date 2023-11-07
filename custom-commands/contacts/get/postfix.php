<?php

if ( $orders_count_from ) {

    $filteredOrders = [];

    foreach ( $response[ "data" ] as $contact ) {

        $API->returnResponse($contact);

        $orders = $API->DB->from( "orders" )
            ->where( "sourse_contact", $contact[ "id" ] );

        $count = 0;

        foreach ( $orders as $order ) {

            $count++;

        }

        if ( $orders_count_from <= $count ) {

            $filteredOrders[] = $contact;

        }

    }

    /**
     * Запись в выдачу
     */
    $response[ "data" ] = $filteredOrders;

}

if ( $orders_count_to ) {

    $filteredOrders = [];

    foreach ( $response[ "data" ] as $contact ) {

        $orders = $API->DB->from( "orders" )
            ->where( "sourse_contact", $contact[ "id" ] );

        $count = 0;

        foreach ( $orders as $order ) {

            $count++;

        }

        if ( $orders_count_to >= $count ) {

            $filteredOrders[] = $contact;

        }

    }

    /**
     * Запись в выдачу
     */
    $response[ "data" ] = $filteredOrders;

}

if ( $orders_cost_from ) {

    $filteredOrders = [];

    foreach ( $response[ "data" ] as $contact ) {

        $orders = $API->DB->from( "orders" )
            ->where( "sourse_contact", $contact[ "id" ] );

        $cost = 0;

        foreach ( $orders as $order ) {

            $cost += $order[ "cost" ];

        }

        if ( $orders_cost_from <= $cost ) {

            $filteredOrders[] = $contact;

        }

    }

    /**
     * Запись в выдачу
     */
    $response[ "data" ] = $filteredOrders;

}

if ( $orders_cost_to ) {

    $filteredOrders = [];

    foreach ( $response[ "data" ] as $contact ) {

        $orders = $API->DB->from( "orders" )
            ->where( "sourse_contact", $contact[ "id" ] );

        $cost = 0;

        foreach ( $orders as $order ) {

            $cost += $order[ "cost" ];

        }

        if ( $orders_cost_to >= $cost ) {

            $filteredOrders[] = $contact;

        }

    }

    /**
     * Запись в выдачу
     */
    $response[ "data" ] = $filteredOrders;


}