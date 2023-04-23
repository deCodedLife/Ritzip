<?php

/**
 * Подключение к базе данных
 */

$db_connection = mysqli_connect(
    "localhost",
    "ritzip",
    "3b170RsD0HB0CB54",
    "ritzipcrm_bril-holding"
);


/**
 * Получение расходов с повторениями
 */

$expenses = mysqli_query( $db_connection, "SELECT * FROM expenses WHERE `repeat_days` IS NOT NULL" );

foreach ( $expenses as $expense ) {

    /**
     * Проверка срока жизни расхода
     */
    if ( ( $expense[ "cycles_count" ] < 1 ) && ( $expense[ "is_endlessly" ] != "Y" ) ) continue;


    /**
     * Получение даты последнего повтора расхода
     */
    $lastRepeatDate = $expense[ "repeated_at" ];
    if ( !$lastRepeatDate ) $lastRepeatDate = date( "Y-m-d", strtotime( $expense[ "created_at" ] ) );

    /**
     * Получение кол-ва дней после последнего повтора
     */
    $daysAfterLastRepeat = round( ( time() - strtotime( $lastRepeatDate ) ) / ( 60 * 60 * 24 ) );


    /**
     * Проверка актуальности повторного расхода
     */
    if ( $expense[ "repeat_days" ] > $daysAfterLastRepeat ) continue;


    /**
     * Повтор расхода
     */
    mysqli_query(
        $db_connection,
        "INSERT INTO expenses ( type_id, cost, description, paymentType_id ) VALUES ( '" . $expense[ "type_id" ] . "', '" . $expense[ "cost" ] . "', '" . $expense[ "description" ] . "', '" . $expense[ "paymentType_id" ] . "' )"
    );

    /**
     * Обновление даты последнего повтора
     */
    mysqli_query(
        $db_connection,
        "UPDATE expenses SET repeated_at = '" . date( "Y-m-d" ) . "' WHERE id = '" . $expense[ "id" ] . "'"
    );

    /**
     * Обновление кол-ва оставшихся циклов
     */
    if ( $expense[ "is_endlessly" ] != "Y" ) mysqli_query(
        $db_connection,
        "UPDATE expenses SET cycles_count = '" . $expense[ "cycles_count" ] - 1 . "' WHERE id = '" . $expense[ "id" ] . "'"
    );

} // foreach. $expenses