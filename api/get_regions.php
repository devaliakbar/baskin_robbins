<?php
require 'db/db.php';
require 'middleware/middleware.php';
require 'db/table/typehead_help.php';

$user = Middleware::verifyToken();

//CREATING RESPONCE FORMAT
$response = array();
$response["success"] = false;
$response["status"] = "INVALID";

$Query = "SELECT DISTINCT " . TypeheadHelper::$COLUMN_REGION . " FROM " . TypeheadHelper::$TABLE_NAME;

$result = mysqli_query($conn, $Query);

if (mysqli_num_rows($result) > 0) {
    $response["success"] = true;
    $cursorArray = array();
    while ($row = mysqli_fetch_assoc($result)) {
        array_push($cursorArray, $row[TypeheadHelper::$COLUMN_REGION]);
    }
    $response["regions"] = $cursorArray;
} else {
    $response["status"] = "EMPTY";
}

echo json_encode($response);
