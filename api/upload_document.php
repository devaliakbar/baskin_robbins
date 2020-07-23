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
if ($user['type'] != 0) {
    $response["status"] = "ACCESS";
    echo json_encode($response);
    die();
}

//GETTING EXPENSE ID FOR FETCHING DETAILS
if (!isset($_GET['id'])) {
    $response["status"] = "ID";
    echo json_encode($response);
    die();
}

$id = $_GET['id'];

$GetVisitQuery = "SELECT " . VisitedDetails::$COLUMN_DOCUMENT_PATH . " FROM " . VisitedDetails::$TABLE_NAME . " WHERE " . VisitedDetails::$ID . " = '" . $id . "'";
$GetVisitresult = mysqli_query($conn, $GetVisitQuery);
$visitDetails = mysqli_fetch_assoc($GetVisitresult);

$oldUrl = $visitDetails[VisitedDetails::$COLUMN_DOCUMENT_PATH];
if ($oldUrl != "") {
    $filePath = "../" . $oldUrl;
    if (file_exists($filePath)) {
        unlink($filePath);
    }
}

$src = $_FILES['document']['tmp_name'];
$fileName = $id . $_FILES['document']['name'];
$targ = "../uploads/" . $fileName;
move_uploaded_file($src, $targ);

$UpdateVisitedDetailsQuery = "UPDATE
" . VisitedDetails::$TABLE_NAME . "
SET
" . VisitedDetails::$COLUMN_DOCUMENT_PATH . " = 'uploads/" . $fileName . "'
WHERE
" . VisitedDetails::$ID . " = '" . $id . "'";

mysqli_query($conn, $UpdateVisitedDetailsQuery);

$response["success"] = true;
echo json_encode($response);
