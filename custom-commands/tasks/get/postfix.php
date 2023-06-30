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


if (
    ( $requestData->context->block === "list" ) &&
    ( $requestData->context->page !== "drivers" ) &&
    ( $requestData->context->page !== "contacts" ) &&
    ( $requestData->context->page !== "cars" ) &&
    ( $requestData->context->page !== "companies" ) &&
    ( $requestData->context->page !== "clients" )
) {

    /**
     * Получение списка задач, где текущий пользователь является Автором
     */
    $authorTasks = $API->sendRequest( "tasks", "get", [ "author_id" => (int) $API::$userDetail->id ] );


    /**
     * Добавление поставленных задач в список
     */
    foreach ( $authorTasks as $authorTask )
        $response[ "data" ][] = (array) $authorTask;


    /**
     * Фильтр дубликатов
     */
    $filteredTasks = arrayUniqueByKey( $response[ "data" ], "id" );


    /**
     * Перевод задач в массив
     */

    $response[ "data" ] = [];

    foreach ( $filteredTasks as $filteredTask )
        $response[ "data" ][] = (array) $filteredTask;

} // if. $requestData->context === "list"
