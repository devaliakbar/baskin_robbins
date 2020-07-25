<?php

require 'db/db.php';
require 'middleware/middleware.php';
require 'utility/mysql_escape.php';
require 'db/table/typehead_help.php';

$user = Middleware::verifyToken();

//CREATING RESPONCE FORMAT
$response = array();
$response["success"] = false;
$response["status"] = "INVALID";

//IF USER IS NOT ADMIN KILL REQUEST
if ($user['type'] != 0) {
    $response["status"] = "ACCESS";
    echo json_encode($response);
    die();
}

//GETTING BODY VARIABLES
$body = new MySqlEscape(json_decode(file_get_contents('php://input'), true), $conn);

$id = $body->getValue('id');

//IF ID IS EMPTY KILL THE REQUEST
if ($id == "") {
    $response["status"] = "FIELD";
    echo json_encode($response);
    die();
}

$DeleteParlorQuery = "DELETE
FROM
" . TypeheadHelper::$TABLE_NAME . "
WHERE
" . TypeheadHelper::$ID . " = '" . $id . "'";

if (mysqli_query($conn, $DeleteParlorQuery)) {
    $response["success"] = true;
} else {
    $response["status"] = "FAILED";
}

echo json_encode($response);
