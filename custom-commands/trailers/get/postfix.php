<?php

if ( $requestData->context->block === "form_list" ) {

    $trailers = [];

    foreach ( $response[ "data" ] as $trailer ) {

        $trailerDetail = $API->DB->from( "trailers" )
            ->where( "id", $trailer[ "value" ] )
            ->limit( 1 )
            ->fetch();

        $trailer[ "title" ] = $trailerDetail[ "brand" ] . ", " . $trailerDetail[ "yearOfRelease" ] . ", " .  $trailerDetail[ "vin" ];

        $trailers[] = $trailer;

    }

    $response[ "data" ] = $trailers;

}

if ( $requestData->context->block == "list" ) {

    function format_phone_number($number)
    {

        $cleaned_number = preg_replace('/\D/', '', $number);
        $formatted_number = "(" . substr($cleaned_number, 0, 3) . ") " . substr($cleaned_number, 3, 3) . "-" . substr($cleaned_number, 6);
        return $formatted_number;

    }

    $trailers = [];

    foreach ($response["data"] as $trailer) {

        $user = $API->DB->from("users")
            ->where("id", $trailer["responsible_id"]["value"])
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

        $trailer["responsible_id"]["title"] = $user["last_name"] . " " . $user["first_name"] . $role["title"] . $user["phone"];

        $allOrder = $API->DB->from( "orders" )
            ->where([
                "trailer_id" => $trailer[ "id" ]
            ]);

        $trailer[ "countOrder" ] = count( $allOrder );

        $order = $API->DB->from("orders")
            ->where([
                "trailer_id" => $trailer["id"],
                "not status_id" => ["21", "22", "25", "26"],
                "is_active" => "Y"
            ])
            ->orderBy("created_at desc")
            ->limit(1)
            ->fetch();

        $car = $API->DB->from("cars")
            ->where("trailer_id", $trailer["id"])
            ->limit(1)
            ->fetch();

        $trailer["car_id"] = [

            "value" => $car["id"],
            "title" => $car["vin"]

        ];

        $orderStatus = $API->DB->from( "orderStatuses" )
            ->where( "id", $order[ "status_id" ] )
            ->limit(1)
            ->fetch();

        if ( $order[ "id" ] ) {

            $trailer[ "order" ][ "href" ] = "orders/update/" . $order[ "id" ];
            $trailer[ "order" ][ "title" ] = $order[ "id" ];

            $trailer[ "orderStatus" ] = [

                "value" => $order[ "status_id" ],
                "title" => $orderStatus[ "title" ]

            ];

        } else {

            $trailer[ "order" ][ "value" ] = "";
            $trailer[ "order" ][ "title" ] = "нет";

        }

        $task = $API->DB->from("tasks")
            ->where([
                "trailer_id" => $trailer["id"]
            ])
            ->orderBy("created_at desc")
            ->limit(1)
            ->fetch();

        $custom_list = [
            "not_read" => [
                "value" => "not_read",
                "title" => "Не начата"
            ],
            "processing" => [
                "value" => "processing",
                "title" => "В процессе"
            ],
            "read" => [
                "value" => "read",
                "title" => "В ожидании ответа"
            ],
            "completed" => [
                "value" => "completed",
                "title" => "Завершена"
            ]
        ];
        if ( $task[ "id" ] ) {

            $trailer[ "task_id" ][ "href" ] = "tasks/update/" . $task[ "id" ];
            $trailer[ "task_id" ][ "title" ] = $task[ "id" ];
            $trailer[ "taskStatus" ] = $custom_list[ $task[ "status" ] ];

        } else {

            $trailer[ "task_id" ][ "value" ] = "";
            $trailer[ "task_id" ][ "title" ] = "Без задачи";

        }

        $trailers[] = $trailer;

    }

    $response["data"] = $trailers;


    if ($orderRq == "Y") {

        $cars = [];

        foreach ($response["data"] as $key => $car) {

            if ($car["order"] != "нет") {

                $cars[] = $car;

            }

        }

        $response["data"] = $cars;
        $response["data"] = array_slice($response["data"], $limit * $requestData->page - $limit, $limit);

    } elseif ($orderRq == "N") {

        $cars = [];

        foreach ($response["data"] as $key => $car) {

            if ($car["order"] == "нет") {

                $cars[] = $car;

            }

        }

        $response["data"] = $cars;
        $response["data"] = array_slice($response["data"], $limit * $requestData->page - $limit, $limit);

    }

    if ($carRq == "Y") {

        $cars = [];

        foreach ($response["data"] as $key => $car) {

            if (!empty($car["car_id"]["value"])) {

                $cars[] = $car;

            }

        }

        $response["data"] = $cars;
        $response["data"] = array_slice($response["data"], $limit * $requestData->page - $limit, $limit);

    } elseif ($carRq == "N") {

        $cars = [];

        foreach ($response["data"] as $key => $car) {

            if (empty($car["car_id"]["value"])) {

                $cars[] = $car;

            }

        }

        $response["data"] = $cars;
        $response["data"] = array_slice($response["data"], $limit * $requestData->page - $limit, $limit);

    }


    if ($taskRq == "Y") {

        $cars = [];

        foreach ($response["data"] as $key => $car) {

            if ($car["task_id"] != "нет") {

                $cars[] = $car;

            }

        }

        $response["data"] = $cars;
        $response["data"] = array_slice($response["data"], $limit * $requestData->page - $limit, $limit);

    } elseif ($taskRq == "N") {

        $cars = [];

        foreach ($response["data"] as $key => $car) {

            if ($car["task_id"] == "нет") {

                $cars[] = $car;

            }

        }

        $response["data"] = $cars;
        $response["data"] = array_slice($response["data"], $limit * $requestData->page - $limit, $limit);

    }


    if ($taskStatuses) {

        $cars = [];

        foreach ($response["data"] as $key => $driver) {

            if (in_array($driver["taskStatus"]["value"], $taskStatuses)) {

                $cars[] = $driver;

            }

            $response["data"] = $cars;
            $response["data"] = array_slice($response["data"], $limit * $requestData->page - $limit, $limit);

        }

    }
}