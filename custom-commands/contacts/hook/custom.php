<?php

/**
 * Вывод поля причины отмены
 */
$formFieldsUpdate = [];

/**
 * Переключение Компания - Клиент
 */
if ( $requestData->company_id ) {

} // switch. $requestData->purchaseType

$API->returnResponse( $formFieldsUpdate );
