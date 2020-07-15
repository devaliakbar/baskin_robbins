<?php
require 'db/db.php';
require 'middleware/middleware.php';
require 'utility/mysql_escape.php';

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

$fileName = $body->getValue('fileName');

if ($fileName == "") {
    $response["status"] = "FIELD";
    echo json_encode($response);
    die();
}

$filePath = "../uploads/" . $fileName;

if (!file_exists($filePath)) {
    $response["status"] = "NOT_EXIST";
    echo json_encode($response);
    die();
}

if (!unlink($filePath)) {
    $response["status"] = "FAILED";
} else {
    $response["success"] = true;
}

echo json_encode($response);
