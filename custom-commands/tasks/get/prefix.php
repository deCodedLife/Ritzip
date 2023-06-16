<?php

/**
 * Принудительная фильтрация по исполнителю
 */
if ( $requestData->context === "list" ) $requestData->employee_id = $API::$userDetail->id;
