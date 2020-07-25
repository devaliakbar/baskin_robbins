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

$region = $body->getValue('region');
$location = $body->getValue('location');
$parlor = $body->getValue('parlor');
$parlorCode = $body->getValue('parlorCode');
$lat = $body->getValue('lat');
$lon = $body->getValue('lon');

//IF THESE VARIABLES ARE EMPTY KILL THE REQUEST
if ($region == "" || $location == "" || $parlor == "" || $parlorCode == "" || $lat == "" || $lon == "") {
    $response["status"] = "FIELD";
    echo json_encode($response);
    die();
}

$InsertParlorQuery = "INSERT INTO " . TypeheadHelper::$TABLE_NAME . "(
    " . TypeheadHelper::$COLUMN_REGION . " ,
    " . TypeheadHelper::$COLUMN_LOCATION . " ,
    " . TypeheadHelper::$COLUMN_PARLOR . " ,
    " . TypeheadHelper::$COLUMN_PARLOR_CODE . " ,
    " . TypeheadHelper::$COLUMN_LAT . " ,
    " . TypeheadHelper::$COLUMN_LON . "
)
VALUES(
    '" . $body->passForSafeSql($region) . "',
    '" . $body->passForSafeSql($location) . "',
    '" . $body->passForSafeSql($parlor) . "',
    '" . $body->passForSafeSql($parlorCode) . "',
    '" . $body->passForSafeSql($lat) . "',
    '" . $body->passForSafeSql($lon) . "'
)";

if (mysqli_query($conn, $InsertParlorQuery)) {
    $response["success"] = true;
} else {
    $response["status"] = "FAILED";
}

echo json_encode($response);
