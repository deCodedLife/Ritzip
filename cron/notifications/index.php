<?php

/**
 * Подключение к базе данных
 */

$mysqli = new mysqli(
    "localhost",
    "ritzip",
    "3b170RsD0HB0CB54",
    "ritzipcrm_bril-holding");

/**
 * Проверка соединения
 */
if ( $mysqli->connect_error ) {

    die( "Ошибка подключения к базе данных: " . $mysqli->connect_error );

} // if. $mysqli->connect_error

/**
 * Получаем все задачи из базы данных
 */
$query = "SELECT * FROM reminders WHERE is_send = 'N' AND notification_at <= '" . date( "Y-m-d H:i:s" ) . "'";
$result = $mysqli->query( $query );


/**
 * Обход напоминаний
 */
while ( $row = $result->fetch_assoc() ) {

    /**
     * Игнорирование напоминаний без даты
     */
    if ( !$row[ "notification_at" ] ) continue;


    /**
     *  ID уведомления
     */
    $notificationId = $row[ "id" ];

    /**
     *  ID сотрудника уведомления
     */
    $notificationUserId = $row[ "user_id" ];

    /**
     *  Название уведомления
     */
    $notificationTitle = $row[ "title" ];

    /**
     *  Описание уведомления
     */
    $notificationDescription = $row[ "description" ];


    /**
     * Отправка уведомления
     */
    $mysqli->query(
        "INSERT INTO notifications ( title, description, status, user_id ) VALUES ( '$notificationTitle', '$notificationDescription', 'info', $notificationUserId )"
    );

    /**
     * Смена статуса задачи
     */
    $mysqli->query( "UPDATE reminders SET is_send = 'Y' WHERE id = '$notificationId'" );

} // while. $result->fetch_assoc()

/**
 * Закрытие соединение с базой данных
 */
$mysqli->close();
