<?php

require 'db/db.php';
require 'middleware/middleware.php';
require 'utility/mysql_escape.php';
require 'db/table/vistited_details.php';
require 'db/table/camera_details.php';
require 'db/table/dvr_details.php';
require 'db/table/network_cable_details.php';
require 'db/table/tv_details.php';

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

///////////////////
//TRANSACTION BEGIN
mysqli_autocommit($conn, false);
///////////////////

//DELETING ALL PRIVIOUS CAMERA RECORD OF THIS VISIT
$DeleteCameraRecordsQuery = "DELETE
FROM
" . CameraDetails::$TABLE_NAME . "
WHERE
" . CameraDetails::$COLUMN_VISITED_ID . " = '" . $id . "'";

//IF FAIL TO DELETE, ROLL BACK AND KILL REQUEST
if (!mysqli_query($conn, $DeleteCameraRecordsQuery)) {
    mysqli_rollback($conn);
    $response["status"] = "CAMERA_DETAILS";
    echo json_encode($response);
    die();
}

//DELETING ALL PRIVIOUS DVR RECORD OF THIS VISIT
$DeleteDvrRecordsQuery = "DELETE
FROM
" . DVRDetails::$TABLE_NAME . "
WHERE
" . DVRDetails::$COLUMN_VISITED_ID . " = '" . $id . "'";

//IF FAIL TO DELETE, ROLL BACK AND KILL REQUEST
if (!mysqli_query($conn, $DeleteDvrRecordsQuery)) {
    mysqli_rollback($conn);
    $response["status"] = "DVR_DETAILS";
    echo json_encode($response);
    die();
}

//DELETING ALL PRIVIOUS NETWORK CABEL RECORD OF THIS VISIT
$NetworkCabelRecordsQuery = "DELETE
FROM
" . NetworkCableDetails::$TABLE_NAME . "
WHERE
" . NetworkCableDetails::$COLUMN_VISITED_ID . " = '" . $id . "'";

//IF FAIL TO DELETE, ROLL BACK AND KILL REQUEST
if (!mysqli_query($conn, $NetworkCabelRecordsQuery)) {
    mysqli_rollback($conn);
    $response["status"] = "NETWORK_CABEL_DETAILS";
    echo json_encode($response);
    die();
}

//DELETING ALL PRIVIOUS TV RECORD OF THIS VISIT
$DeleteTVRecordsQuery = "DELETE
FROM
" . TVDetails::$TABLE_NAME . "
WHERE
" . TVDetails::$COLUMN_VISITED_ID . " = '" . $id . "'";

//IF FAIL TO DELETE, ROLL BACK AND KILL REQUEST
if (!mysqli_query($conn, $DeleteTVRecordsQuery)) {
    mysqli_rollback($conn);
    $response["status"] = "TV_DETAILS";
    echo json_encode($response);
    die();
}

//FINALLY DELETING VISIT
$DeleteVisitQuery = "DELETE
FROM
" . VisitedDetails::$TABLE_NAME . "
WHERE
" . VisitedDetails::$ID . " = '" . $id . "'";

//IF FAIL TO DELETE, ROLL BACK AND KILL REQUEST
if (!mysqli_query($conn, $DeleteVisitQuery)) {
    mysqli_rollback($conn);
    $response["status"] = "VISIT";
    echo json_encode($response);
    die();
}

mysqli_commit($conn);
$response["success"] = true;
echo json_encode($response);
