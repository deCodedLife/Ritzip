<?php

/**
 * @file Глобальный поиск
 */


/**
 * Список совпадений
 */
$resultMatches = [];


/**
 * Объявление объекта sphinx
 */

$Sphinx = new SphinxClient();

$Sphinx->SetSortMode( SPH_SORT_RELEVANCE  );
$Sphinx->SetArrayResult( true );

$Sphinx->SetLimits( 0, 5 );


/**
 * Поиск совпадения - Пользователи
 */

$searchIdList = $Sphinx->Query(
    $requestData->search,
    str_replace( "-", "_", $API::$configs[ "db" ][ "name" ] ) . "_users"
);

if ( $searchIdList[ "matches" ] ) {

    /**
     * Категория поиска
     */
    $searchCategory = [
        "title" => "Пользователи",
        "rows" => []
    ];


    /**
     * Поиск записей
     */

    $findRowsId = [];

    foreach ( $searchIdList[ "matches" ] as $searchId ) $findRowsId[] = $searchId[ "id" ];

    $rows = $API->DB->from( "users" )
        ->where( "id", $findRowsId )
        ->limit( 5 );


    /**
     * Вывод найденных записей
     */

    foreach ( $rows as $row ) {

        /**
         * Получение роли пользователя
         */
        $userRole = $API->DB->from( "roles" )
            ->where( "id", $row[ "role_id" ] )
            ->limit( 1 )
            ->fetch();

        $searchCategory[ "rows" ][] = [
            "title" => $row[ "last_name" ] . " " . $row[ "first_name" ] . " " . $row[ "patronymic" ],
            "description" => $userRole[ "title" ],
            "href" => "/" . $userRole[ "article" ] . "/update/" . $userRole[ "id" ]
        ];

    } // foreach. $rows


    if ( $searchCategory[ "rows" ] ) $resultMatches[] = $searchCategory;

} // if. $searchIdList[ "matches" ]


/**
 * Поиск совпадения - Автомобили
 */

$searchIdList = $Sphinx->Query(
    $requestData->search,
    str_replace( "-", "_", $API::$configs[ "db" ][ "name" ] ) . "_cars"
);

if ( $searchIdList[ "matches" ] ) {

    /**
     * Категория поиска
     */
    $searchCategory = [
        "title" => "Автомобили",
        "rows" => []
    ];


    /**
     * Поиск записей
     */

    $findRowsId = [];

    foreach ( $searchIdList[ "matches" ] as $searchId ) $findRowsId[] = $searchId[ "id" ];

    $rows = $API->DB->from( "cars" )
        ->where( "id", $findRowsId )
        ->limit( 5 );


    /**
     * Вывод найденных записей
     */

    foreach ( $rows as $row ) {

        $searchCategory[ "rows" ][] = [
            "title" => $row[ "vin" ],
            "description" => $row[ "brand" ] . " " . $row[ "model" ],
            "href" => "/cars/update/" . $row[ "id" ]
        ];

    } // foreach. $rows


    if ( $searchCategory[ "rows" ] ) $resultMatches[] = $searchCategory;

} // if. $searchIdList[ "matches" ]


/**
 * Поиск совпадения - Транспортные средства на отправку
 */

$searchIdList = $Sphinx->Query(
    $requestData->search,
    str_replace( "-", "_", $API::$configs[ "db" ][ "name" ] ) . "_vehicles"
);

if ( $searchIdList[ "matches" ] ) {

    /**
     * Категория поиска
     */
    $searchCategory = [
        "title" => "Транспортные средства на отправку",
        "rows" => []
    ];


    /**
     * Поиск записей
     */

    $findRowsId = [];

    foreach ( $searchIdList[ "matches" ] as $searchId ) $findRowsId[] = $searchId[ "id" ];

    $rows = $API->DB->from( "vehicles" )
        ->where( "id", $findRowsId )
        ->limit( 5 );


    /**
     * Вывод найденных записей
     */

    foreach ( $rows as $row ) {

        $searchCategory[ "rows" ][] = [
            "title" => $row[ "vin" ],
            "description" => $row[ "brand" ] . " " . $row[ "model" ],
            "href" => "/vehicles/update/" . $row[ "id" ]
        ];

    } // foreach. $rows


    if ( $searchCategory[ "rows" ] ) $resultMatches[] = $searchCategory;

} // if. $searchIdList[ "matches" ]


$API->returnResponse( $resultMatches );