<?php

mysqli_query(
    $API->DB_connection,
    "ALTER TABLE users DROP COLUMN companyCategory_id"
);