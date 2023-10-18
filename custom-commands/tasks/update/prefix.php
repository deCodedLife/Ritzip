<?php

/**
 * Удаления шаблона повтора
 */
unset( $requestData->repeat_templates );

if ( $requestData->is_end == "Y" ) {

    $requestData->status = "completed";

}