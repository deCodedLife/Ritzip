<?php

/**
 * Игнорирование ролей из меню
 */

$filteredRoles = [];

foreach ( $blockField[ "list" ] as $role ) {

    switch ( $role[ "value" ] ) {

        case 1:
        case 3:
        case 4:
        case 13:
            break;

        default:
            $filteredRoles[] = $role;

    } // switch. $role[ "value" ]

} // foreach. $blockField[ "list" ]

$blockField[ "list" ] = $filteredRoles;