<?php

$pageScheme[ "structure" ][ 1 ][ "settings" ][ "filters" ] = [
    [
        "property" => "created_at_from",
        "value" => date("Y-m-d", strtotime("-1 months")) . " 00:00:00"
    ],
    [
        "property" => "created_at_to",
        "value" => date( 'Y-m-d' ) . " 23:59:59"
    ]
];