<?php

$updateHeaders = [];

foreach ( $listStructure[ "headers" ] as $header ) {

    if ($header[ "article" ] != "patronymic"){

        $updateHeaders[] = $header;

    }

}

$listStructure[ "headers" ] = $updateHeaders;


