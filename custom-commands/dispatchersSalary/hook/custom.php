<?php

if ( $requestData->salaryType == "percent" ) {

    $formFieldsUpdate[ "salaryPercent"][ "is_visible" ] = true;
    $formFieldsUpdate[ "salarySum"][ "is_visible" ] = false;

} else {

    $formFieldsUpdate[ "salaryPercent" ][ "is_visible" ] = false;
    $formFieldsUpdate[ "salarySum" ][ "is_visible" ] = true;

}
$API->returnResponse( $formFieldsUpdate );
