<?php
require 'db/db.php';
require 'middleware/middleware.php';
require 'db/table/typehead_help.php';

$user = Middleware::verifyToken();

//CREATING RESPONCE FORMAT
$response = array();
$response["success"] = false;
$response["status"] = "INVALID";

$Query = "SELECT * FROM " . TypeheadHelper::$TABLE_NAME . " WHERE 1";

if (isset($_GET['region'])) {
    if (isset($_GET['location'])) {
        $Query = $Query . " AND " . TypeheadHelper::$COLUMN_REGION . " = '" . $_GET['region'] . "' AND " . TypeheadHelper::$COLUMN_LOCATION . " = '" . $_GET['location'] . "'";
    } else {
        $Query = $Query . " AND " . TypeheadHelper::$COLUMN_REGION . " = '" . $_GET['region'] . "'";
    }
}

$result = mysqli_query($conn, $Query);

if (mysqli_num_rows($result) > 0) {
    $response["success"] = true;
    $temp = array();
    $cursorArray = array();

    while ($row = mysqli_fetch_assoc($result)) {
        $temp['id'] = $row[TypeheadHelper::$ID];
        $temp['region'] = $row[TypeheadHelper::$COLUMN_REGION];
        $temp['location'] = $row[TypeheadHelper::$COLUMN_LOCATION];
        $temp['parlor'] = $row[TypeheadHelper::$COLUMN_PARLOR];
        $temp['parlorCode'] = $row[TypeheadHelper::$COLUMN_PARLOR_CODE];
        $temp['lat'] = $row[TypeheadHelper::$COLUMN_LAT];
        $temp['lon'] = $row[TypeheadHelper::$COLUMN_LON];
        array_push($cursorArray, $temp);
    }
    $response["parlors"] = $cursorArray;
} else {
    $response["status"] = "EMPTY";
}

echo json_encode($response);
