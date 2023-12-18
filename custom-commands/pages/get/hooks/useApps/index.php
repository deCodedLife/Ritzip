<?php

$useApps = $API->DB->from( "useApps" )
    ->limit(1)
    ->fetch();

if ( $useApps[ "salaryType"] == "percent" ) {

    $formFieldValues[ "salaryPercent"][ "is_visible" ] = true;
    $formFieldValues[ "salarySum"][ "is_visible" ] = false;

} else {

    $formFieldValues[ "salaryPercent" ][ "is_visible" ] = false;
    $formFieldValues[ "salarySum" ][ "is_visible" ] = true;

}
