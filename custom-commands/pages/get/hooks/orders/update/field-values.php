<?php
/**
 * Отображение скрытых полей если они заполнены
 */
if ( $pageDetail[ "row_detail" ][ "reason_id" ] ) $formFieldValues[ "reason_id" ][ "is_visible" ] = true;
if ( $pageDetail[ "row_detail" ][ "client_id" ] ) $formFieldValues[ "client_id" ][ "is_visible" ] = true;
if ( $pageDetail[ "row_detail" ][ "company_id" ] ) $formFieldValues[ "company_id" ][ "is_visible" ] = true;
