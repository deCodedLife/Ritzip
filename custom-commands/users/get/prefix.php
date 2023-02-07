<?php

/**
 * Принудительный фильтр раздела "Остальные пользователи"
 */
if ( $requestData->is_list && !$requestData->role_id )
    $requestSettings[ "filter" ][ "role_id > ?" ] = 10;