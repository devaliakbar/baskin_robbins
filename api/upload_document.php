<?php
require 'db/db.php';
require 'middleware/middleware.php';

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

$src = $_FILES['document']['tmp_name'];
$fileName = $id . $_FILES['document']['name'];
$targ = "../uploads/" . $fileName;
move_uploaded_file($src, $targ);

$response["success"] = true;
$response["fileName"] = $fileName;
echo json_encode($response);
