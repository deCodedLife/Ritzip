<?php

/**
 * Игнорирование повторяющихся элементов многомерного массива по ключу
 *
 * @param  $array  array   Входящий массив
 * @param  $key    string  Ключ, по которому сверяются элементы
 *
 * @return array
 */
function arrayUniqueByKey ( $array, $key ) {

    global $API;

    $filteredArray = [];
    $checkedKeys = [];
    $i = 0;

    foreach( $array as $arrayItem ) {

        if ( !in_array( $arrayItem[ $key ], $checkedKeys ) ) {
            $checkedKeys[ $i ] = $arrayItem[ $key ];
            $filteredArray[ $i ] = $arrayItem;
        }

        $i++;

    } // foreach. $array

    return $filteredArray;

} // function. arrayUniqueByKey


if ( $requestData->context === "list" ) {

    /**
     * Получение списка задач, где текущий пользователь является Автором
     */
    $authorTasks = $API->sendRequest( "tasks", "get", [ "author_id" => (int) $API::$userDetail->id ] );


    /**
     * Добавление поставленных задач в список
     */
    foreach ( $authorTasks as $authorTask ) {

        $response[ "data" ][] = (array) $authorTask;

    } // foreach. $authorTasks


    $response[ "data" ] = arrayUniqueByKey( $response[ "data" ], "id" );

} // if. $requestData->context === "list"