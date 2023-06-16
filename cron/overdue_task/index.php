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
$query = "SELECT * FROM tasks";
$result = $mysqli->query( $query );


/**
 * Обход задач
 */
while ( $row = $result->fetch_assoc() ) {

    /**
     * Игнорирование задач без дедлайна
     */
    if ( !$row[ "deadline" ] ) continue;

    /**
     * Игнорирование завершенных задач
     */
    if (
        ( $row[ "status" ] == "completed" ) ||
        ( $row[ "status" ] == "success" )
    ) continue;


    /**
     *  ID задачи
     */
    $taskId = $row[ "id" ];

    /**
     * Дата и время дедлайна задачи (в unix timestamp)
     */
    $taskDeadline = strtotime( $row[ "deadline" ] );

    /**
     * Текущее время (в unix timestamp)
     */
    $timeNow = time();

    /**
     * Если задача просрочена
     */
    if ( $taskDeadline < $timeNow ) {

        /**
         * Смена статуса задачи
         */
        $mysqli->query( "UPDATE tasks SET status = 'overdue' WHERE id = '" . $row[ "id" ] . "'" );

    } // if. $taskDeadline < $timeNow

} // while. $result->fetch_assoc()

/**
 * Закрытие соединение с базой данных
 */
$mysqli->close();
