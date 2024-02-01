<?php


$API->DB->update( "payments" )
    ->set( [
        "transaction_id" => $insertId
    ] )
    ->where( "id", $insertId )
    ->execute();


/**
 * Обновление статуса Счета
 */
if ( $requestData->account_id ) {

    $accountDetail = $API->DB->from( "accounts" )
        ->where( "id", $requestData->account_id )
        ->limit( 1 )
        ->fetch();

    $accountPayments = $API->DB->from( "payments" )
        ->where( "account_id", $requestData->account_id );


    /**
     * Текущая сумма оплаты Счета
     */

    $accountPaymentSum = 0;

    foreach ( $accountPayments as $accountPayment )
        $accountPaymentSum += $accountPayment[ "sum" ];


    /**
     * Актуализация статуса оплаты
     */

    if ( $accountPaymentSum >= $accountDetail[ "sum" ] ) {

        $API->DB->update( "accounts" )
            ->set( "status", "paid" )
            ->where( "id", $requestData->account_id )
            ->execute();

    } elseif ( $accountPaymentSum ) {

        $API->DB->update( "accounts" )
            ->set( "status", "partially" )
            ->where( "id", $requestData->account_id )
            ->execute();

    }

} // if. $requestData->account_id