<?php

if ( $requestData->mileage ) {

    $automationRules = $API->DB->from( "automationRules" )
        ->limit(1)
        ->fetch();

    if ( $automationRules[ "tech_spec_car_mileage_data" ] == "Y" && $API::$userDetail->role_id != 28 ) {

        $API->returnResponse( "Только Технический специалист может вносить данные по пробегу авто", 400 );

    }

}