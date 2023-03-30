<?php

/**
 * Добавление уведомлений
 */

$API->addNotification(
    "system_alerts",
    "Добавлена задача",
    $requestData->description,
    "info",
    $requestData->employee_id
);