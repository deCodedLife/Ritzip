<?php

/**
 * Авто-заполнение автора
 */
$requestData->author_id = $API::$userDetail->id;


/**
 * Удаления шаблона повтора
 */
unset( $requestData->repeat_templates );
