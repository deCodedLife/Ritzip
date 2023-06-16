<?php

/**
 * Отправка уведомления о новом напоминании пользлователю
 */
$API->addNotification( 2, "У вас новое напоминание", $requestData->title, "info", $requestData->user_id );
