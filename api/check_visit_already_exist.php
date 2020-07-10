<?php
require 'db/db.php';
require 'middleware/middleware.php';
require 'db/table/vistited_details.php';

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

//GETTING PARLOR , REGION AND LOCATION
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

if (!isset($_GET['parlor'])) {
    $response["status"] = "PARLOR";
    echo json_encode($response);
    die();
}

if (!isset($_GET['visited_time'])) {
    $response["status"] = "TIME";
    echo json_encode($response);
    die();
}

$region = $_GET['region'];
$location = $_GET['location'];
$parlor = $_GET['parlor'];
$visitedTime = $_GET['visited_time'];

$CheckAlreadyExist = "SELECT " . VisitedDetails::$ID
. " FROM " . VisitedDetails::$TABLE_NAME
. " WHERE " . VisitedDetails::$COLUMN_REGION . " = '" . $region
. "' AND " . VisitedDetails::$COLUMN_LOCATION . " = '" . $location
. "' AND " . VisitedDetails::$COLUMN_TIME . " = '" . $visitedTime
. "' AND " . VisitedDetails::$COLUMN_PARLOUR . " = '" . $parlor . "'";

if (isset($_GET['ID'])) {
    $id = $_GET['ID'];
    $CheckAlreadyExist = $CheckAlreadyExist . " AND " . VisitedDetails::$ID . " <> '" . $id . "'";
}

$result = mysqli_query($conn, $CheckAlreadyExist);

if (mysqli_num_rows($result) > 0) {
    $response["success"] = false;
    $response["status"] = "EXIST";
} else {
    $response["success"] = true;
}

echo json_encode($response);
