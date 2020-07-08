<?php
require 'db/db.php';
require 'middleware/middleware.php';
require 'db/table/user.php';
require 'db/table/jwt_token.php';
require 'utility/mysql_escape.php';

$user = Middleware::verifyToken();

//CREATING RESPONCE FORMAT
$response = array();
$response["success"] = false;
$response["status"] = "INVALID";

if ($user['type'] != 0) {
    $response["status"] = "ACCESS";
    echo json_encode($response);
    die();
}

$UpdatePasswordQuery = "UPDATE
" . User::$TABLE_NAME . "
SET
" . User::$COLUMN_PASSWORD . " =  MD5('password')";

if (mysqli_query($conn, $UpdatePasswordQuery)) {
    $response["success"] = true;
} else {
    $response["status"] = "FAILED";
}

echo json_encode($response);
