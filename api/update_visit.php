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
if ($user['type'] == 2) {
    $response["status"] = "ACCESS";
    echo json_encode($response);
    die();
}

//GETTING BODY VARIABLES
$body = new MySqlEscape(json_decode(file_get_contents('php://input'), true), $conn);

$id = $body->getValue('id');
$date = $body->getValue('date');
$region = $body->getValue('region');
$location = $body->getValue('location');
$parlor = $body->getValue('parlor');

//IF THESE VARIABLES ARE EMPTY KILL THE REQUEST
if ($id == "" || $date == "" || $region == "" || $location == "" || $parlor == "") {
    $response["status"] = "FIELD";
    echo json_encode($response);
    die();
}

///////////////////
//TRANSACTION BEGIN
mysqli_autocommit($conn, false);
///////////////////

$visitedTime = ""; // $body->getValue('visitedTime'); //TRASH

$comment = $body->getValue('comment');
$verifiedBy = $body->getValue('verifiedBy');
$verifiedDate = $body->getValue('verifiedDate') == "" ? "0000-00-00" : $body->getValue('verifiedDate');
$checkedBy = $body->getValue('checkedBy');
$checkedDate = $body->getValue('checkedDate') == "" ? "0000-00-00" : $body->getValue('checkedDate');
$approvedBy = $body->getValue('approvedBy');
$approvedDate = $body->getValue('approvedDate') == "" ? "0000-00-00" : $body->getValue('approvedDate');
$documentPath = $body->getValue('documentPath');

$UpdateVisitedDetailsQuery = "UPDATE
" . VisitedDetails::$TABLE_NAME . "
SET
" . VisitedDetails::$COLUMN_DATE . " = '" . $date . "' ,
" . VisitedDetails::$COLUMN_REGION . " = '" . $body->passForSafeSql($region) . "' ,
" . VisitedDetails::$COLUMN_LOCATION . " = '" . $body->passForSafeSql($location) . "' ,
" . VisitedDetails::$COLUMN_PARLOUR . " = '" . $body->passForSafeSql($parlor) . "' ,
" . VisitedDetails::$COLUMN_TIME . " = '" . $body->passForSafeSql($visitedTime) . "' ,
" . VisitedDetails::$COLUMN_COMMENT . " = '" . $body->passForSafeSql($comment) . "' ,
" . VisitedDetails::$COLUMN_VERIFIED_BY . " = '" . $body->passForSafeSql($verifiedBy) . "' ,
" . VisitedDetails::$COLUMN_VERIFIED_DATE . " = '" . $body->passForSafeSql($verifiedDate) . "' ,
" . VisitedDetails::$COLUMN_CHECKED_BY . " = '" . $body->passForSafeSql($checkedBy) . "' ,
" . VisitedDetails::$COLUMN_CHECKED_DATE . " = '" . $body->passForSafeSql($checkedDate) . "' ,
" . VisitedDetails::$COLUMN_APPROVED_BY . " = '" . $body->passForSafeSql($approvedBy) . "' ,
" . VisitedDetails::$COLUMN_APPROVED_DATE . " = '" . $body->passForSafeSql($approvedDate) . "' ,
" . VisitedDetails::$COLUMN_DOCUMENT_PATH . " = '" . $documentPath . "'
WHERE
" . VisitedDetails::$ID . " = '" . $body->passForSafeSql($id) . "'";

//IF FAIL TO INSERT ROLL BACK AND KILL REQUEST
if (!mysqli_query($conn, $UpdateVisitedDetailsQuery)) {
    mysqli_rollback($conn);
    $response["status"] = "VISITED_DETAILS";
    echo json_encode($response);
    die();
}

//CAMERA DETAILS
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

$cameraDetailsList = $body->getValue('cameraDetailsList');

foreach ($cameraDetailsList as $cameraDetails) {
    $type = $cameraDetails['type'];
    $brand = $cameraDetails['brand'];
    $count = $cameraDetails['count'] == "" ? 0 : $cameraDetails['count'];
    $status = $cameraDetails['status'];
    $remark = $cameraDetails['remark'];
    $ip = $cameraDetails['ip'];
    $suggestions = $cameraDetails['suggestions'];

    $InsertCameraDetailsQuery = "INSERT INTO " . CameraDetails::$TABLE_NAME . "(
        " . CameraDetails::$COLUMN_VISITED_ID . " ,
        " . CameraDetails::$COLUMN_TYPE . " ,
        " . CameraDetails::$COLUMN_BRAND . " ,
        " . CameraDetails::$COLUMN_COUNT . " ,
        " . CameraDetails::$COLUMN_STATUS . " ,
        " . CameraDetails::$COLUMN_REMARK . " ,
        " . CameraDetails::$COLUMN_IP_DETAIL . " ,
        " . CameraDetails::$COLUMN_SUGGESTION . "
    )
    VALUES(
        '" . $id . "',
        '" . $body->passForSafeSql($type) . "',
        '" . $body->passForSafeSql($brand) . "',
        '" . $body->passForSafeSql($count) . "',
        '" . $body->passForSafeSql($status) . "',
        '" . $body->passForSafeSql($remark) . "',
        '" . $body->passForSafeSql($ip) . "',
        '" . $body->passForSafeSql($suggestions) . "'
    )";

    //IF FAIL TO INSERT, ROLL BACK AND KILL REQUEST
    if (!mysqli_query($conn, $InsertCameraDetailsQuery)) {
        mysqli_rollback($conn);
        $response["status"] = "CAMERA_DETAILS";
        echo json_encode($response);
        die();
    }
}

//DVR DETAILS
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

$dvrDetailsList = $body->getValue('dvrDetailsList');

foreach ($dvrDetailsList as $dvrDetails) {
    $noChannels = $dvrDetails['noChannels'] == "" ? 0 : $dvrDetails['noChannels'];
    $brand = $dvrDetails['brand'];
    $availability = $dvrDetails['availability'];
    $hddCapacity = $dvrDetails['hddCapacity'];
    $remark = $dvrDetails['remark'];
    $suggestions = $dvrDetails['suggestions'];

    $InsertDvrDetailsQuery = "INSERT INTO " . DVRDetails::$TABLE_NAME . "(
        " . DVRDetails::$COLUMN_VISITED_ID . " ,
        " . DVRDetails::$COLUMN_NO_CHANNELS . " ,
        " . DVRDetails::$COLUMN_BRAND . " ,
        " . DVRDetails::$COLUMN_RECORDING_AVAILABILITY . " ,
        " . DVRDetails::$COLUMN_HDD_CAPACITY . " ,
        " . DVRDetails::$COLUMN_REMARK . " ,
        " . DVRDetails::$COLUMN_SUGGESTION . "
    )
    VALUES(
        '" . $id . "',
        '" . $body->passForSafeSql($noChannels) . "',
        '" . $body->passForSafeSql($brand) . "',
        '" . $body->passForSafeSql($availability) . "',
        '" . $body->passForSafeSql($hddCapacity) . "',
        '" . $body->passForSafeSql($remark) . "',
        '" . $body->passForSafeSql($suggestions) . "'
    )";

    //IF FAIL TO INSERT, ROLL BACK AND KILL REQUEST
    if (!mysqli_query($conn, $InsertDvrDetailsQuery)) {
        mysqli_rollback($conn);
        $response["status"] = "DVR_DETAILS";
        echo json_encode($response);
        die();
    }

}

//NETWORK CABEL DETAILS
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

$networkCabelDetailsList = $body->getValue('networkCabelDetailsList');

foreach ($networkCabelDetailsList as $networkCabelDetails) {
    $networkPoint = $networkCabelDetails['networkPoint'];
    $status = $networkCabelDetails['status'];
    $suggestions = $networkCabelDetails['suggestions'];

    $InsertNetworkCabelDetailsQuery = "INSERT INTO " . NetworkCableDetails::$TABLE_NAME . "(
        " . NetworkCableDetails::$COLUMN_VISITED_ID . " ,
        " . NetworkCableDetails::$COLUMN_NETWORK_POINT . " ,
        " . NetworkCableDetails::$COLUMN_STATUS . " ,
        " . NetworkCableDetails::$COLUMN_SUGGESTION . "
    )
    VALUES(
        '" . $id . "',
        '" . $body->passForSafeSql($networkPoint) . "',
        '" . $body->passForSafeSql($status) . "',
        '" . $body->passForSafeSql($suggestions) . "'
    )";

    //IF FAIL TO INSERT, ROLL BACK AND KILL REQUEST
    if (!mysqli_query($conn, $InsertNetworkCabelDetailsQuery)) {
        mysqli_rollback($conn);
        $response["status"] = "NETWORK_CABEL_DETAILS";
        echo json_encode($response);
        die();
    }
}

//TV DETAILS
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

$tvDetailsList = $body->getValue('tvDetailsList');

foreach ($tvDetailsList as $tvDetails) {
    $networkPoint = $tvDetails['networkPoint'];
    $status = $tvDetails['status'];
    $remark = $tvDetails['remark'];
    $suggestions = $tvDetails['suggestions'];

    $InsertTvDetailsQuery = "INSERT INTO " . TVDetails::$TABLE_NAME . "(
        " . TVDetails::$COLUMN_VISITED_ID . " ,
        " . TVDetails::$COLUMN_NETWORK_POINT . " ,
        " . TVDetails::$COLUMN_STATUS . " ,
        " . TVDetails::$COLUMN_REMARK . " ,
        " . TVDetails::$COLUMN_SUGGESTION . "
    )
    VALUES(
        '" . $id . "',
        '" . $body->passForSafeSql($networkPoint) . "',
        '" . $body->passForSafeSql($status) . "',
        '" . $body->passForSafeSql($remark) . "',
        '" . $body->passForSafeSql($suggestions) . "'
    )";

    //IF FAIL TO INSERT, ROLL BACK AND KILL REQUEST
    if (!mysqli_query($conn, $InsertTvDetailsQuery)) {
        mysqli_rollback($conn);
        $response["status"] = "TV_DETAILS";
        echo json_encode($response);
        die();
    }
}

mysqli_commit($conn);
$response["success"] = true;
echo json_encode($response);
