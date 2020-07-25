<?php
require 'db/db.php';
require 'middleware/middleware.php';
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

//GETTING VISIT ID FOR FETCHING DETAILS
if (!isset($_GET['id'])) {
    $response["status"] = "ID";
    echo json_encode($response);
    die();
}

$visitId = $_GET['id'];

$GetVisitQuery = "SELECT * FROM " . VisitedDetails::$TABLE_NAME . " WHERE " . VisitedDetails::$ID . " = '" . $visitId . "'";

$GetVisitresult = mysqli_query($conn, $GetVisitQuery);
if (mysqli_num_rows($GetVisitresult) > 0) {
    $response["success"] = true;

    $resultArray = array();

    $visitDetails = mysqli_fetch_assoc($GetVisitresult);
    $resultArray['date'] = $visitDetails[VisitedDetails::$COLUMN_DATE];
    $resultArray['region'] = $visitDetails[VisitedDetails::$COLUMN_REGION];
    $resultArray['location'] = $visitDetails[VisitedDetails::$COLUMN_LOCATION];
    $resultArray['parlor'] = $visitDetails[VisitedDetails::$COLUMN_PARLOUR];

    $resultArray['parlorCode'] = $visitDetails[VisitedDetails::$COLUMN_PARLOR_CODE];
    $resultArray['lat'] = $visitDetails[VisitedDetails::$COLUMN_LAT];
    $resultArray['lon'] = $visitDetails[VisitedDetails::$COLUMN_LON];

    $resultArray['visitedTime'] = $visitDetails[VisitedDetails::$COLUMN_TIME];
    $resultArray['comment'] = $visitDetails[VisitedDetails::$COLUMN_COMMENT];
    $resultArray['verifiedBy'] = $visitDetails[VisitedDetails::$COLUMN_VERIFIED_BY];
    $resultArray['verifiedDate'] = $visitDetails[VisitedDetails::$COLUMN_VERIFIED_DATE];
    $resultArray['checkedBy'] = $visitDetails[VisitedDetails::$COLUMN_CHECKED_BY];
    $resultArray['checkedDate'] = $visitDetails[VisitedDetails::$COLUMN_CHECKED_DATE];
    $resultArray['approvedBy'] = $visitDetails[VisitedDetails::$COLUMN_APPROVED_BY];
    $resultArray['approvedDate'] = $visitDetails[VisitedDetails::$COLUMN_APPROVED_DATE];
    $resultArray['documentPath'] = $visitDetails[VisitedDetails::$COLUMN_DOCUMENT_PATH];

    //GETTING CAMERA DETALS OF THIS VISIT
    $GetCameraDetailsQuery = "SELECT * FROM " . CameraDetails::$TABLE_NAME . " WHERE " . CameraDetails::$COLUMN_VISITED_ID . " = '" . $visitId . "'";
    $GetCameraDetailsResult = mysqli_query($conn, $GetCameraDetailsQuery);
    if (mysqli_num_rows($GetCameraDetailsResult) > 0) {
        $temp = array();
        $cursorArray = array();

        while ($row = mysqli_fetch_assoc($GetCameraDetailsResult)) {
            $temp['type'] = $row[CameraDetails::$COLUMN_TYPE];
            $temp['brand'] = $row[CameraDetails::$COLUMN_BRAND];
            $temp['count'] = $row[CameraDetails::$COLUMN_COUNT];
            $temp['status'] = $row[CameraDetails::$COLUMN_STATUS];
            $temp['remark'] = $row[CameraDetails::$COLUMN_REMARK];
            $temp['ip'] = $row[CameraDetails::$COLUMN_IP_DETAIL];
            $temp['suggestions'] = $row[CameraDetails::$COLUMN_SUGGESTION];
            array_push($cursorArray, $temp);
        }
        $resultArray["cameraDetailsList"] = $cursorArray;
    }

    //GETTING DVR DETALS OF THIS VISIT
    $GetDvrDetailsQuery = "SELECT * FROM " . DVRDetails::$TABLE_NAME . " WHERE " . DVRDetails::$COLUMN_VISITED_ID . " = '" . $visitId . "'";
    $GetDvrDetailsResult = mysqli_query($conn, $GetDvrDetailsQuery);
    if (mysqli_num_rows($GetDvrDetailsResult) > 0) {
        $temp = array();
        $cursorArray = array();

        while ($row = mysqli_fetch_assoc($GetDvrDetailsResult)) {
            $temp['noChannels'] = $row[DVRDetails::$COLUMN_NO_CHANNELS];
            $temp['brand'] = $row[DVRDetails::$COLUMN_BRAND];
            $temp['availability'] = $row[DVRDetails::$COLUMN_RECORDING_AVAILABILITY];
            $temp['hddCapacity'] = $row[DVRDetails::$COLUMN_HDD_CAPACITY];
            $temp['remark'] = $row[DVRDetails::$COLUMN_REMARK];
            $temp['suggestions'] = $row[DVRDetails::$COLUMN_SUGGESTION];
            array_push($cursorArray, $temp);
        }
        $resultArray["dvrDetailsList"] = $cursorArray;
    }

    //GETTING NETWORK CABEL DETALS OF THIS VISIT
    $GetNetworkCabelDetailsQuery = "SELECT * FROM " . NetworkCableDetails::$TABLE_NAME . " WHERE " . NetworkCableDetails::$COLUMN_VISITED_ID . " = '" . $visitId . "'";
    $GetNetworkCabelDetailsResult = mysqli_query($conn, $GetNetworkCabelDetailsQuery);
    if (mysqli_num_rows($GetNetworkCabelDetailsResult) > 0) {
        $temp = array();
        $cursorArray = array();

        while ($row = mysqli_fetch_assoc($GetNetworkCabelDetailsResult)) {
            $temp['networkPoint'] = $row[NetworkCableDetails::$COLUMN_NETWORK_POINT];
            $temp['status'] = $row[NetworkCableDetails::$COLUMN_STATUS];
            $temp['suggestions'] = $row[NetworkCableDetails::$COLUMN_SUGGESTION];
            array_push($cursorArray, $temp);
        }
        $resultArray["networkCabelDetailsList"] = $cursorArray;
    }

    //GETTING TV DETALS OF THIS VISIT
    $GetTvDetailsQuery = "SELECT * FROM " . TVDetails::$TABLE_NAME . " WHERE " . TVDetails::$COLUMN_VISITED_ID . " = '" . $visitId . "'";
    $GetTvDetailsResult = mysqli_query($conn, $GetTvDetailsQuery);
    if (mysqli_num_rows($GetTvDetailsResult) > 0) {
        $temp = array();
        $cursorArray = array();

        while ($row = mysqli_fetch_assoc($GetTvDetailsResult)) {
            $temp['networkPoint'] = $row[TVDetails::$COLUMN_NETWORK_POINT];
            $temp['status'] = $row[TVDetails::$COLUMN_STATUS];
            $temp['remark'] = $row[TVDetails::$COLUMN_REMARK];
            $temp['suggestions'] = $row[TVDetails::$COLUMN_SUGGESTION];
            array_push($cursorArray, $temp);
        }
        $resultArray["tvDetailsList"] = $cursorArray;
    }

    //ADDIING FINAL RESULT TO RESPONCE
    $response["visitDetails"] = $resultArray;
} else {
    $response["status"] = "EMPTY";
}

echo json_encode($response);
