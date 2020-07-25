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
if ($user['type'] == 2) {
    $response["status"] = "ACCESS";
    echo json_encode($response);
    die();
}

//GETTING BODY VARIABLES
$body = new MySqlEscape(json_decode(file_get_contents('php://input'), true), $conn);

$id = $body->getValue('id');
$region = $body->getValue('region');
$location = $body->getValue('location');
$parlor = $body->getValue('parlor');
$parlorCode = $body->getValue('parlorCode');
$lat = $body->getValue('lat');
$lon = $body->getValue('lon');

//IF THESE VARIABLES ARE EMPTY KILL THE REQUEST
if ($id == "" || $region == "" || $location == "" || $parlor == "" || $parlorCode == "" || $lat == "" || $lon == "") {
    $response["status"] = "FIELD";
    echo json_encode($response);
    die();
}

$UpdateParlorQuery = "UPDATE
" . TypeheadHelper::$TABLE_NAME . "
SET
" . TypeheadHelper::$COLUMN_REGION . " = '" . $body->passForSafeSql($region) . "',
" . TypeheadHelper::$COLUMN_LOCATION . " = '" . $body->passForSafeSql($location) . "',
" . TypeheadHelper::$COLUMN_PARLOR . " = '" . $body->passForSafeSql($parlor) . "',
" . TypeheadHelper::$COLUMN_PARLOR_CODE . " = '" . $body->passForSafeSql($parlorCode) . "',
" . TypeheadHelper::$COLUMN_LAT . " = '" . $body->passForSafeSql($lat) . "',
" . TypeheadHelper::$COLUMN_LON . " = '" . $body->passForSafeSql($lon) . "'
WHERE
_id = '" . $id . "'";

if (mysqli_query($conn, $UpdateParlorQuery)) {
    $response["success"] = true;
} else {
    $response["status"] = "FAILED";
}

echo json_encode($response);
