<?php
/**
 * Вывод поля причины отмены
 */
$formFieldsUpdate = [];

if ( ! empty ( $requestData->cancellationReason ) ) {

    $formFieldsUpdate[ "cancellationReason" ] = [ "is_visible" => true ];

}
$API->returnResponse( $formFieldsUpdate );
