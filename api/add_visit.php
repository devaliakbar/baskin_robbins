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

$date = $body->getValue('date');
$region = $body->getValue('region');
$location = $body->getValue('location');
$parlor = $body->getValue('parlor');

//IF THESE VARIABLES ARE EMPTY KILL THE REQUEST
if ($date == "" || $region == "" || $location == "" || $parlor == "") {
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

$InsertVisitedDetailsQuery = "INSERT INTO " . VisitedDetails::$TABLE_NAME . "(
    " . VisitedDetails::$COLUMN_DATE . " ,
    " . VisitedDetails::$COLUMN_REGION . " ,
    " . VisitedDetails::$COLUMN_LOCATION . " ,
    " . VisitedDetails::$COLUMN_PARLOUR . " ,
    " . VisitedDetails::$COLUMN_TIME . " ,
    " . VisitedDetails::$COLUMN_COMMENT . " ,
    " . VisitedDetails::$COLUMN_VERIFIED_BY . " ,
    " . VisitedDetails::$COLUMN_VERIFIED_DATE . " ,
    " . VisitedDetails::$COLUMN_CHECKED_BY . " ,
    " . VisitedDetails::$COLUMN_CHECKED_DATE . " ,
    " . VisitedDetails::$COLUMN_APPROVED_BY . " ,
    " . VisitedDetails::$COLUMN_APPROVED_DATE . " ,
    " . VisitedDetails::$COLUMN_DOCUMENT_PATH . "
)
VALUES(
'" . $date . "',
'" . $body->passForSafeSql($region) . "',
'" . $body->passForSafeSql($location) . "',
'" . $body->passForSafeSql($parlor) . "',
'" . $body->passForSafeSql($visitedTime) . "',
'" . $body->passForSafeSql($comment) . "',
'" . $body->passForSafeSql($verifiedBy) . "',
'" . $verifiedDate . "',
'" . $body->passForSafeSql($checkedBy) . "',
'" . $checkedDate . "',
'" . $body->passForSafeSql($approvedBy) . "',
'" . $approvedDate . "',
'" . $documentPath . "'
)";

//IF FAIL TO INSERT ROLL BACK AND KILL REQUEST
if (!mysqli_query($conn, $InsertVisitedDetailsQuery)) {
    mysqli_rollback($conn);
    $response["status"] = "VISITED_DETAILS";
    echo json_encode($response);
    die();
}

$visitedId = mysqli_insert_id($conn);

//CAMERA DETAILS
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
        '" . $visitedId . "',
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
        '" . $visitedId . "',
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
        '" . $visitedId . "',
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
        '" . $visitedId . "',
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
