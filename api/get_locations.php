<?php
require 'db/db.php';
require 'middleware/middleware.php';
require 'db/table/typehead_help.php';

$user = Middleware::verifyToken();

//CREATING RESPONCE FORMAT
$response = array();
$response["success"] = false;
$response["status"] = "INVALID";

//GETTING REGION FOR FETCHING CORRESPONDING LOCATION
if (!isset($_GET['region'])) {
    $response["status"] = "REGION";
    echo json_encode($response);
    die();
}

$region = $_GET['region'];

$Query = "SELECT DISTINCT " . TypeheadHelper::$COLUMN_LOCATION
. " FROM "
. TypeheadHelper::$TABLE_NAME
. " WHERE " . TypeheadHelper::$COLUMN_REGION . " = '" . $region . "'";

$result = mysqli_query($conn, $Query);

if (mysqli_num_rows($result) > 0) {
    $response["success"] = true;
    $cursorArray = array();
    while ($row = mysqli_fetch_assoc($result)) {
        array_push($cursorArray, $row[TypeheadHelper::$COLUMN_LOCATION]);
    }
    $response["locations"] = $cursorArray;
} else {
    $response["status"] = "EMPTY";
}

echo json_encode($response);
