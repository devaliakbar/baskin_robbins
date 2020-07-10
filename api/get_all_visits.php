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

//GETTING ALL VISITS
$GetVisitQuery = "SELECT
" . VisitedDetails::$COLUMN_DATE . " ,
" . VisitedDetails::$COLUMN_TIME . " ,
" . VisitedDetails::$COLUMN_PARLOUR . " ,
" . VisitedDetails::$COLUMN_LOCATION . " ,
" . VisitedDetails::$COLUMN_REGION . " ,
" . VisitedDetails::$COLUMN_VERIFIED_BY . " ,
" . VisitedDetails::$COLUMN_CHECKED_BY . " ,
" . VisitedDetails::$COLUMN_APPROVED_BY . "
 FROM " . VisitedDetails::$TABLE_NAME . " WHERE 1";

//////////////////////////
//CONDITION IF QUERY EXIST
if (isset($_GET['from_date'])) {
    if (isset($_GET['to_date'])) {
        $GetVisitQuery = $GetVisitQuery . " AND " . VisitedDetails::$COLUMN_DATE . " BETWEEN '" . $_GET['from_date'] . "' AND '" . $_GET['to_date'] . "'";
    } else {
        $GetVisitQuery = $GetVisitQuery . " AND " . VisitedDetails::$COLUMN_DATE . " = '" . $_GET['from_date'] . "'";
    }
}

if (isset($_GET['visited_time'])) {
    $GetVisitQuery = $GetVisitQuery . " AND " . VisitedDetails::$COLUMN_TIME . " = '" . $_GET['visited_time'] . "'";
}

if (isset($_GET['region'])) {
    $GetVisitQuery = $GetVisitQuery . " AND " . VisitedDetails::$COLUMN_REGION . " = '" . $_GET['region'] . "'";
}

if (isset($_GET['location'])) {
    $GetVisitQuery = $GetVisitQuery . " AND " . VisitedDetails::$COLUMN_LOCATION . " = '" . $_GET['location'] . "'";
}

if (isset($_GET['parlor'])) {
    $GetVisitQuery = $GetVisitQuery . " AND " . VisitedDetails::$COLUMN_PARLOUR . " = '" . $_GET['parlor'] . "'";
}

//////////////////////////

$GetVisitresult = mysqli_query($conn, $GetVisitQuery);
if (mysqli_num_rows($GetVisitresult) > 0) {
    $response["success"] = true;
    $temp = array();
    $cursorArray = array();

    while ($row = mysqli_fetch_assoc($GetVisitresult)) {
        $temp['date'] = $row[VisitedDetails::$COLUMN_DATE];
        $temp['visitedTime'] = $row[VisitedDetails::$COLUMN_TIME];
        $temp['parlour'] = $row[VisitedDetails::$COLUMN_PARLOUR];
        $temp['location'] = $row[VisitedDetails::$COLUMN_LOCATION];
        $temp['region'] = $row[VisitedDetails::$COLUMN_REGION];
        $temp['verifiedBy'] = $row[VisitedDetails::$COLUMN_VERIFIED_BY];
        $temp['checkedBy'] = $row[VisitedDetails::$COLUMN_CHECKED_BY];
        $temp['approvedBy'] = $row[VisitedDetails::$COLUMN_APPROVED_BY];
        array_push($cursorArray, $temp);
    }
    $response["visits"] = $cursorArray;

} else {
    $response["status"] = "EMPTY";
}

echo json_encode($response);
