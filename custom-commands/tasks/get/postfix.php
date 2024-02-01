<?php


if ( $requestData->context->block == "list" ) {

    $userDetail = $API->DB->from( "users" )
        ->where( "id", $API::$userDetail->id)
        ->limit( 1 )
        ->fetch();

    function format_phone_number($number)
    {

        $cleaned_number = preg_replace('/\D/', '', $number);
        $formatted_number = "(" . substr($cleaned_number, 0, 3) . ") " . substr($cleaned_number, 3, 3) . "-" . substr($cleaned_number, 6);
        return $formatted_number;

    }

    if ($requestData->is_repeatable == "Y") {

        $priorities = [
            [
                "value" => "low",
                "title" => "Низкий"
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
                "value" => "not_read",
                "title" => "Не начата"
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
            "SELECT * FROM `tasks` WHERE is_active = 'Y' AND employee_id = " . $API::$userDetail->id . " GROUP BY title HAVING COUNT(title) > 1"
        );

        foreach ($tasks as $task) {

            $tasksUpdated = $API->DB->from("tasks")
                ->where([
                    "title" => $task["title"],
                    "is_active" => "Y"
                ]);

            foreach ($tasksUpdated as $taskUpdated) {

                $employee = $API->DB->from("users")
                    ->where("id", $taskUpdated["employee_id"])
                    ->limit(1)
                    ->fetch();

                $author = $API->DB->from("users")
                    ->where("id", $taskUpdated["author_id"])
                    ->limit(1)
                    ->fetch();

                foreach ($statuses as $status) {

                    if ($status["value"] == $taskUpdated["status"]) $taskUpdated["status_title"] = $status["title"];

                }

                foreach ($priorities as $priority) {

                    if ($priority["value"] == $taskUpdated["priority"]) $taskUpdated["priority_title"] = $priority["title"];


                }

                $taskUpdated = [
                    "id" => $taskUpdated[ "id" ],
                    "title" => $taskUpdated["title"],
                    "employee_id" => [
                        "title" => $employee["last_name"],
                        "value" => $taskUpdated["employee_id"]
                    ],
                    "author_id" => [
                        "title" => $author["last_name"],
                        "value" => $taskUpdated["author_id"]
                    ],
                    "description" => $taskUpdated["description"],
                    "status" => [
                        "title" => $taskUpdated["status_title"],
                        "value" => $taskUpdated["status"]
                    ],
                    "priority" => [
                        "title" => $taskUpdated["priority_title"],
                        "value" => $taskUpdated["priority"]
                    ],
                    "created_at" => $taskUpdated["created_at"],
                    "deadline" => $taskUpdated["deadline"]
                ];

                $return[] = $taskUpdated;

            }

        }

        $response["data"] = $return;

        $response["detail"] = [

            "pages_count" => ceil(count($response["data"]) / $requestSettings["limit"]),
            "rows_count" => count($response["data"])

        ];

        $response["data"] = array_slice($response["data"], $requestData->limit * $requestData->page - $requestData->limit, $requestData->limit);

    }

    $today = date("Y-m-d H:i:s");

    $return = [];

    foreach ($response["data"] as $task) {

        $user = $API->DB->from("users")
            ->where("id", $task["employee_id"]["value"])
            ->limit(1)
            ->fetch();

        $role = $API->DB->from("roles")
            ->where("id", $user["role_id"])
            ->limit(1)
            ->fetch();

        if ($user["phone"]) {

            $user["phone"] = ", " . format_phone_number($user["phone"]);

        }

        if ($role) {

            $role["title"] = ", " . $role["title"];

        }

        $customList = [
            "contact" => [
                "title" => "contacts",
                "value" => "contact"
            ],
            "company" => [
                "title" => "companies",
                "value" => "company"
            ],
            "order" => [
                "title" => "orders",
                "value" => "order"
            ],
            "car" => [
                "title" => "cars",
                "value" => "car"
            ],
            "driver" => [
                "title" => "drivers",
                "value" => "driver"
            ],
            "trailer" => [
                "title" => "trailers",
                "value" => "trailer"
            ],
            "expense" => [
                "title" => "expenses",
                "value" => "expense"
            ]
        ];

        $allTasks = $API->DB->from( "tasks" )
            ->where( "is_active", "Y" );

        $count = 0;

        foreach ( $allTasks as $allTask ) {

            if ( $allTask[ "title" ] == $task[ "title" ] && $task[ "title" ] != "" ) {

                $count++;

            }

        }

        if ( $count > 1 )  $task[ "title" ] = $task[ "title" ] . " ( повторяющаяся ) ";


        if ( $task[ "binding" ][ "value" ] != "clear" && $task[ $task[ "binding" ][ "value" ] . "_id" ] ) {

            $href = $customList[ $task[ "binding" ][ "value" ] ][ "title" ] . "/update/" . $task[ $task[ "binding" ][ "value" ] . "_id" ][ "value" ];
            $task[ "bindingLink" ] = [

                "href" => $href,
                "title" => $task[ "binding" ][ "title" ],
                "value" => $task[ "binding" ][ "value" ]

            ];

        } else {

            $task[ "bindingLink" ] = [

                "title" => $task[ "binding" ][ "title" ],
                "value" => $task[ "binding" ][ "value" ]

            ];

        }

        $task["employee_id"]["title"] = $user["last_name"] . " " . $user["first_name"] . $role["title"] . $user["phone"];

        if (!empty($task["deadline"]) && $task["deadline"] <= $today) {

            $task["deadline"] = [

                "color" => "danger",
                "value" => $task["deadline"]

            ];

        }

        $return[] = $task;

    }

    $response["data"] = $return;

}