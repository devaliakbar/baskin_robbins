<?php
require 'db/db.php';
require 'middleware/middleware.php';
require 'db/table/typehead_help.php';

$user = Middleware::verifyToken();

//CREATING RESPONCE FORMAT
$response = array();
$response["success"] = false;
$response["status"] = "INVALID";

//GETTING REGION AND LOCATION FOR FETCHING CORRESPONDING PARLORS
if (!isset($_GET['region'])) {
    $response["status"] = "REGION";
    echo json_encode($response);
    die();
}

if (!isset($_GET['location'])) {
    $response["status"] = "LOCATION";
    echo json_encode($response);
    die();
}

$region = $_GET['region'];
$location = $_GET['location'];

$Query = "SELECT DISTINCT " . TypeheadHelper::$COLUMN_PARLOR
. " FROM "
. TypeheadHelper::$TABLE_NAME
. " WHERE " . TypeheadHelper::$COLUMN_REGION . " = '" . $region . "'
AND " . TypeheadHelper::$COLUMN_LOCATION . " = '" . $location . "'";

$result = mysqli_query($conn, $Query);

if (mysqli_num_rows($result) > 0) {
    $response["success"] = true;
    $cursorArray = array();
    while ($row = mysqli_fetch_assoc($result)) {
        array_push($cursorArray, $row[TypeheadHelper::$COLUMN_PARLOR]);
    }
    $response["parlors"] = $cursorArray;
} else {
    $response["status"] = "EMPTY";
}

echo json_encode($response);
