<?php

/**
 * Принудительный фильтр раздела "Остальные пользователи"
 */
if ( ( $requestData->context === "list" ) && !$requestData->role_id )
    $requestSettings[ "filter" ][ "role_id > ?" ] = 10;