<?php
/**
 * Автоподстановка водителя
 */

 if ( ( $requestData->context->form == "reminders" ) && $requestData->context->row_id )
 $formFieldValues[ "user_id" ] = $requestData->context->row_id;


