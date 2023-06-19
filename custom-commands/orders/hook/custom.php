<?php
/**
 * Вывод поля причины отмены
 */
$formFieldsUpdate = [];

if ( !empty ( $requestData->reason_id ) ) {

    $formFieldsUpdate[ "reason_id" ] = [ "is_visible" => true ];

}
$API->returnResponse( $formFieldsUpdate );
