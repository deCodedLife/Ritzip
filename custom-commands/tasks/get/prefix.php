<?php

/**
 * Принудительная фильтрация по исполнителю
 */
if ( $requestData->is_list ) $requestData->employee_id = $API::$userDetail->id;