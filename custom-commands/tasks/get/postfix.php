<?php

if ( $requestData->is_repeatable == "Y" ) {

    $priorities = [
        [
            "value" =>"low",
            "title" =>"Низкий"
        ],
        [
            "value" => "middle",
            "title" => "Средний"
        ],
        [
            "value" => "height",
            "title" => "Высокий"
        ],
        [
            "value" => "urgent",
            "title" => "Неотложный"
        ]
    ];

    $statuses = [
        [
            "value" =>  "not_read",
            "title" =>  "Не начата"
        ],
        [
            "value" => "processing",
            "title" => "В процессе"
        ],
        [
            "value" => "read",
            "title" => "В ожидании ответа"
        ],
        [
            "value" => "completed",
            "title" => "Завершена"
        ]
    ];

    $return = [];

    $tasks = mysqli_query(
        $API->DB_connection,
        "SELECT * FROM `tasks` WHERE is_active = 'Y' GROUP BY title HAVING COUNT(title) > 1;"
    );

    foreach ( $tasks as $task ) {

        $tasksUpdated = $API->DB->from( "tasks" )
            ->where( "title", $task[ "title" ] );

       foreach ( $tasksUpdated as $taskUpdated ) {

           $employee = $API->DB->from( "users" )
               ->where( "id", $taskUpdated[ "employee_id" ] )
               ->limit( 1 )
               ->fetch( );

           $author = $API->DB->from( "users" )
               ->where( "id", $taskUpdated[ "author_id" ] )
               ->limit( 1 )
               ->fetch( );

           foreach ( $statuses as $status ) {

               if ( $status[ "value" ] == $taskUpdated[ "status" ] ) $taskUpdated[ "status_title" ] = $status[ "title" ];

           }

           foreach ( $priorities as $priority ) {

               if ( $priority[ "value" ] == $taskUpdated[ "priority" ] ) $taskUpdated[ "priority_title" ] = $priority[ "title" ];


           }

           $taskUpdated = [
               "title" => $taskUpdated[ "title" ],
                "employee_id" => [
                    "title" => $employee[ "last_name" ],
                    "value" => $taskUpdated[ "employee_id" ]
                ],
                "author_id" => [
                    "title" => $author[ "last_name" ],
                    "value" => $taskUpdated[ "author_id" ]
                ],
                "description" => $taskUpdated[ "description" ],
                "status" => [
                    "title" => $taskUpdated[ "status_title" ],
                    "value" => $taskUpdated[ "status" ]
                ],
                "priority" => [
                    "title" => $taskUpdated[ "priority_title" ],
                    "value" => $taskUpdated[ "priority" ]
                ],
                "created_at" => $taskUpdated[ "created_at" ],
                "deadline" => $taskUpdated[ "deadline" ]
           ];
           $return[] = $taskUpdated;

       }

    }

    $response[ "data" ] = $return;

}

$today = date("Y-m-d H:i:s");

$return = [];

foreach ( $response[ "data" ] as $task ) {


    if ( !empty( $task[ "deadline" ] ) && $task[ "deadline" ] <= $today ) {

        $task[ "deadline" ] = [

            "color" => "danger",
            "value" => $task[ "deadline" ]

        ];

    }

    $return[] = $task;

}


$response[ "data" ] = $return;



$response[ "detail" ] = [

    "pages_count" => ceil(count($response[ "data" ]) / $requestSettings[ "limit" ]),
    "rows_count" => count($response[ "data" ])

];

$response[ "data" ] = array_slice($response[ "data" ], $requestData->limit * $requestData->page - $requestData->limit, $requestData->limit);