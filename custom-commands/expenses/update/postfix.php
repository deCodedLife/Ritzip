<?php

$automationRules = $API->DB->from( "automationRules" )
    ->limit( 1 )
    ->fetch();

$expense = $API->DB->from( "expenses" )
    ->where( "id", $requestData->id )
    ->limit( 1 )
    ->fetch();


if ( $automationRules[ "accountant_confirms_closing_dispatcher_salary" ] == "Y" && $expense[ "dispatcher_id" ] && $expense[ "order_id" ] && $expense[ "category_id" ] == 9 && $expense[ "status_id" ] == 3  ) {

    $API->DB->update( "orders" )
        ->set( [
            "is_confirmedAccountant" => "Y"
        ] )
        ->where( "id", $expense[ "order_id" ] )
        ->execute();

}


if ( $expense[ "order_id" ] ) {

    $API->addLog( [
        "table_name" => "orders",
        "description" => "Изменен расход: " . $expense[ "title" ],
        "row_id" => $expense[ "id" ]
    ], $requestData );

}