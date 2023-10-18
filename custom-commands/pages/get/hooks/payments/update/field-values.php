<?php
/**
 * Отображение скрытых полей если они заполнены
 */
if ( $pageDetail[ "row_detail" ][ "contact_id" ] ) $formFieldValues[ "contact_id" ][ "is_visible" ] = true;
if ( $pageDetail[ "row_detail" ][ "company_id" ] ) $formFieldValues[ "company_id" ][ "is_visible" ] = true;
if ( $pageDetail[ "row_detail" ][ "order_id" ] ) $formFieldValues[ "order_id" ][ "is_visible" ] = true;
if ( $pageDetail[ "row_detail" ][ "driver_id" ] ) $formFieldValues[ "driver_id" ][ "is_visible" ] = true;
if ( $pageDetail[ "row_detail" ][ "car_id" ] ) $formFieldValues[ "car_id" ][ "is_visible" ] = true;
