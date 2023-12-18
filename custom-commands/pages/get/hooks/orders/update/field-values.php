<?php
/**
 * Отображение скрытых полей если они заполнены
 */
if ( $pageDetail[ "row_detail" ][ "reason_id" ] ) $formFieldValues[ "reason_id" ][ "is_visible" ] = true;
if ( $pageDetail[ "row_detail" ][ "sourse_contact" ] ) $formFieldValues[ "sourse_contact" ][ "is_visible" ] = true;
if ( $pageDetail[ "row_detail" ][ "company_id" ] ) $formFieldValues[ "company_id" ][ "is_visible" ] = true;

if ( $API::$userDetail->role_id == 22) $formFieldValues[ "is_confirmedAccountant" ][ "is_visible" ] = true;

