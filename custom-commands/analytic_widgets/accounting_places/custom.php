<?php

/**
 * @file
 * Отчет по колличеству мест
 */

/**
 * Сформированный отчет
 */
$returnReport = [];


/**
 * Получение заказа
 */
$order = $API->DB->from( "orders" )
    ->where( "id", $requestData->id )
    ->limit( 1 )
    ->fetch();

$company = $API->DB->from( "companies" )
    ->where( "id", $order[ "company_id" ] )
    ->limit( 1 )
    ->fetch();

$sender = $API->DB->from( "users" )
    ->where( "id", $order[ "sender_id" ] )
    ->limit( 1 )
    ->fetch();

$recipient = $API->DB->from( "users" )
    ->where( "id", $order[ "recipient_id" ] )
    ->limit( 1 )
    ->fetch();

$returnReport[] = [
    "value" => $order["placeCount"],
    "description" => "Мест ( всего )",
    "size" => "1",
    "icon" => "",
    "prefix" => "",
    "postfix" => [],
    "background" => "info",
    "detail" => []
];

$returnReport[] = [
    "value" => $order["placeOccupied"],
    "description" => "Мест ( занято )",
    "size" => "1",
    "icon" => "",
    "prefix" => "",
    "postfix" => [],
    "background" => "info",
    "detail" => []
];

$returnReport[] = [
    "value" => $order["placeCount"] - $order["placeOccupied"],
    "description" => "Мест ( Свободно )",
    "size" => "1",
    "icon" => "",
    "prefix" => "",
    "postfix" => [],
    "background" => "info",
    "detail" => []
];

$returnReport[] = [
    "value" => $order["created_at"],
    "description" => "Дата и время начала",
    "size" => "1",
    "icon" => "",
    "prefix" => "",
    "postfix" => [],
    "background" => "info",
    "detail" => []
];

$returnReport[] = [
    "value" => $order["cost"],
    "description" => "Стоимость заказа",
    "size" => "2",
    "icon" => "",
    "prefix" => "",
    "postfix" => [],
    "background" => "info",
    "detail" => []
];


$returnReport[] = [
    "value" => $order["miles"],
    "description" => "Колличество миль",
    "size" => "2",
    "icon" => "",
    "prefix" => "",
    "postfix" => [],
    "background" => "info",
    "detail" => []
];

if ( $company ) {

    $phoneFormat = "+" . sprintf("(%s) %s-%s",
            substr($company [ "phone" ], 0, 3),
            substr($company [ "phone" ], 2, 3),
            substr($company [ "phone" ], 5, 4),
        );

    $returnReport[] = [
        "value" => "Компания",
        "description" => $company["title"] . ", " . $sender["email"] . ", " . $phoneFormat,
        "size" => "4",
        "icon" => "",
        "prefix" => "",
        "postfix" => [],
        "background" => "info",
        "detail" => []
    ];

}

if ( $sender ) {

    $phoneFormat = "+" . sprintf("(%s) %s-%s",
            substr($recipient [ "phone" ], 0, 3),
            substr($recipient [ "phone" ], 2, 3),
            substr($recipient [ "phone" ], 5, 4),
        );

    $returnReport[] = [
        "value" => "Отправитель",
        "description" => $sender["first_name"] . " " . $sender["first_name"] . " " . $sender["patronymic"] . ", " . $sender["email"] . ", " . $phoneFormat . ", " . $recipient[ "address" ],
        "size" => "2",
        "icon" => "",
        "prefix" => "",
        "postfix" => [],
        "background" => "info",
        "detail" => []
    ];
}
if ( $recipient ) {

    $phoneFormat = "+" . sprintf("(%s) %s-%s",
            substr($recipient [ "phone" ], 0, 3),
            substr($recipient [ "phone" ], 2, 3),
            substr($recipient [ "phone" ], 5, 4),
        );

    $returnReport[] = [
        "value" => "Получатель",
        "description" => $recipient[ "first_name" ] . " " .  $recipient[ "first_name" ] . " " .  $recipient[ "patronymic" ] . ", " .  $recipient[ "email" ]  . ", " .  $phoneFormat . ", " . $recipient[ "address" ],
        "size" => "2",
        "icon" => "",
        "prefix" => "",
        "postfix" => [],
        "background" => "info",
        "detail" => []
    ];

}

if ( $order[ "sendingAddress" ] ) {

    $returnReport[] = [
        "value" => "Адрес отправления",
        "description" => $order[ "sendingAddress" ],
        "size" => "2",
        "icon" => "",
        "prefix" => "",
        "postfix" => [],
        "background" => "info",
        "detail" => []
    ];

}

if ( $order[ "receivingAddress" ] ) {

    $returnReport[] = [
        "value" => "Адрес получения",
        "description" => $order[ "receivingAddress" ],
        "size" => "2",
        "icon" => "",
        "prefix" => "",
        "postfix" => [],
        "background" => "info",
        "detail" => []
    ];

}

$API->returnResponse( $returnReport );
