<?php

$previousValue = $API->DB->from( "orders" )
    ->where( [
        "id" => $requestData->id
    ] )
    ->limit( 1 )
    ->fetch();
$driver = $API->DB->from( "users" )
    ->where( [
        "id" => $previousValue['employee_id']
    ] )
    ->limit( 1 )
    ->fetch();
$car = $API->DB->from( "cars" )
    ->where( [
        "id" => $previousValue['car_id']
    ] )
    ->limit( 1 )
    ->fetch();

/**
 * обновление водителя и авто, поле"сумма заказов" при изменении цены водителя или авто в заказе
 */   
$newCar = $API->DB->from( "cars" )
->where( [
    "id" => $requestData->car_id
] )
->limit( 1 )
->fetch();

$newDriver = $API->DB->from( "users" )
->where( [
    "id" => $requestData->employee_id
] )
->limit( 1 )
->fetch();

if ( $requestData->cost ) {   
      
    if ( $requestData->car_id && $requestData->car_id != $car['id'] ){ // если изменяется цена и авто
    
        $API->DB->update( "cars" )
            ->set( [
                "sumOrder" => $car['sumOrder'] - $previousValue['cost'],
                "countOrder" => $car['countOrder'] - 1
            ] )
            ->where( "id", $car['id'] )
            ->execute();

        $API->DB->update( "cars" )
            ->set( [
                "sumOrder" => $newCar['sumOrder'] + $requestData->cost,
                "countOrder" => $newCar['countOrder'] + 1
            ] )
            ->where( "id", $newCar['id'] )
            ->execute();

    } 

    if ( ! $requestData->car_id ) {
       
        $API->DB->update( "cars" )
        ->set( [
        "sumOrder" => $car['sumOrder'] - $previousValue['cost'] + $requestData->cost
        ] )
        ->where( "id", $car['id'])
        ->execute();
    }

    if (  $requestData->employee_id && $requestData->employee_id != $driver['id'] ) { // если изменяется цена и водитель 
    
        $API->DB->update( "users" )
            ->set( [
                "sumOrder" => $driver['sumOrder'] - $previousValue['cost'],
                "countOrder" => $driver['countOrder'] - 1
            ] )
            ->where( "id", $driver['id'] )
            ->execute();
        
        $API->DB->update( "users" )
            ->set( [
                "sumOrder" => $newDriver['sumOrder'] + $requestData->cost,
                "countOrder" => $newDriver['countOrder'] + 1
            ] )
            ->where( "id", $newDriver['id'] )
            ->execute();
    
    } 
    
    if ( ! $requestData->employee_id ) {

        $API->DB->update( "users" )
        ->set( [
        "sumOrder" => $driver['sumOrder'] - $previousValue['cost'] + $requestData->cost
        ] )
        ->where( "id", $driver['id'])
        ->execute();

    }

} else {

    if ( $requestData->car_id && $requestData->car_id != $car['id'] ){ // если изменяется авто а цена та же
    
        $API->DB->update( "cars" )
            ->set( [
                "sumOrder" => $car['sumOrder'] - $previousValue['cost'],
                "countOrder" => $car['countOrder'] - 1
            ] )
            ->where( "id", $car['id'] )
            ->execute();

        $API->DB->update( "cars" )
            ->set( [
                "sumOrder" => $newCar['sumOrder'] + $previousValue['cost'],
                "countOrder" => $newCar['countOrder'] + 1
            ] )
            ->where( "id", $newCar['id'] )
            ->execute();

    } 

    if ( $requestData->employee_id && $requestData->employee_id != $driver['id'] ) { // если изменяется водитель а цена та же
    
        $API->DB->update( "users" )
            ->set( [
                "sumOrder" => $driver['sumOrder'] - $previousValue['cost'],
                "countOrder" => $driver['countOrder'] - 1
            ] )
            ->where( "id", $driver['id'] )
            ->execute();
        
        $API->DB->update( "users" )
            ->set( [
                "sumOrder" => $newDriver['sumOrder'] + $previousValue['cost'],
                "countOrder" => $newDriver['countOrder'] + 1
            ] )
            ->where( "id", $newDriver['id'] )
            ->execute();
    
    }

}

if ( $requestData->miles ) {
  
    if ( ! $requestData->car_id ) { // если изменяется мили но авто то же
       
        $API->DB->update( "cars" )
            ->set( [
                "miles" => (float)$car['miles'] - (float)$previousValue['miles'] + (float)$requestData->miles
            ] )
            ->where( "id", $car['id'] )
            ->execute();

    } 
    if ( $requestData->car_id && $requestData->car_id != $car['id'] ){ // если изменяется мили и авто
        
        $API->DB->update( "cars" )
            ->set( [
                "miles" => $car['miles'] - $previousValue['miles'],
            ] )
            ->where( "id", $car['id'] )
            ->execute();

        $API->DB->update( "cars" )
            ->set( [
                "sumOrder" => $newCar['miles'] + $requestData->miles,
            ] )
            ->where( "id", $newCar['id'] )
            ->execute();

        } 

    if ( ! $requestData->employee_id ) {  // если изменяется мили но водитель то же
    
        $API->DB->update( "users" )
            ->set( [
                "miles" => (float)$driver['miles'] - (float)$previousValue['miles'] + (float)$requestData->miles
            ] )
            ->where( "id", $driver['id'] )
            ->execute();

    } 
    
    if ( $requestData->employee_id && $requestData->employee_id != $driver['id'] ) { // если изменяется мили и водитель 
    
        $API->DB->update( "users" )
            ->set( [
                "miles" => $driver['miles'] - $previousValue['miles'],
            ] )
            ->where( "id", $driver['id'] )
            ->execute();
    
        $API->DB->update( "users" )
            ->set( [
                "miles" => $newDriver['miles'] + $requestData->miles,
            ] )
            ->where( "id", $newDriver['id'] )
            ->execute();


    }

} else {

    if ( $requestData->car_id != $car['id'] ){ // если изменяется авто а мили нет
    
        $API->DB->update( "cars" )
            ->set( [
                "miles" => $car['miles'] - $previousValue['miles'],
            ] )
            ->where( "id", $car['id'] )
            ->execute();

        $API->DB->update( "cars" )
            ->set( [
                "miles" => $newCar['miles'] + $previousValue['miles'],
            ] )
            ->where( "id", $newCar['id'] )
            ->execute();

    } 

    if ( $requestData->employee_id != $driver['id'] ) { // если изменяется водитель а мили нет
    
        $API->DB->update( "users" )
            ->set( [
                "miles" => $driver['miles'] - $previousValue['miles'],
            ] )
            ->where( "id", $driver['id'] )
            ->execute();
    
        $API->DB->update( "users" )
            ->set( [
                "miles" => $newDriver['miles'] + $previousValue['miles'],
            
            ] )
            ->where( "id", $newDriver['id'] )
            ->execute();
            
    }


}



if ( $requestData->status_id ) {
    $API->DB->insertInto( "ordersHistory" )
        ->values( [
            "order_id" => $requestData->id,
            "from_status_id" => $previousValue[ "status_id" ],
            "to_status_id" => $requestData->status_id,
        ] )
        ->execute();

} // if. $requestData->status_id
