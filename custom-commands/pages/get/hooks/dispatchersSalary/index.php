<?php

$dispatchersSalary = $API->DB->from( "dispatchersSalary" )
    ->limit(1)
    ->fetch();

if ( $dispatchersSalary[ "salaryType"] == "percent" ) {

    $formFieldValues[ "salaryPercent"][ "is_visible" ] = true;
    $formFieldValues[ "salarySum"][ "is_visible" ] = false;

} else {

    $formFieldValues[ "salaryPercent" ][ "is_visible" ] = false;
    $formFieldValues[ "salarySum" ][ "is_visible" ] = true;

}
