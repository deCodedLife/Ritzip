<?php

/**
 * Автоподстановка суммы оплаты
 */

if ( ( $requestData->context->form == "payment" ) && $requestData->context->row_id )
    $formFieldValues[ "needPay" ] = $requestData->context->row_id;



