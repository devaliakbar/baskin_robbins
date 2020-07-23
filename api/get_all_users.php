<?php
require 'db/db.php';
require 'middleware/middleware.php';
require 'db/table/user.php';

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

$Query = "SELECT * FROM " . User::$TABLE_NAME . " ORDER BY " . User::$COLUMN_NAME;

$result = mysqli_query($conn, $Query);

if (mysqli_num_rows($result) > 0) {
    $response["success"] = true;
    $temp = array();
    $cursorArray = array();

    while ($row = mysqli_fetch_assoc($result)) {
        $temp['id'] = $row[User::$ID];
        $temp['name'] = $row[User::$COLUMN_NAME];
        $temp['username'] = $row[User::$COLUMN_USERNAME];
        $temp['type'] = $row[User::$COLUMN_TYPE];
        array_push($cursorArray, $temp);
    }
    $response["users"] = $cursorArray;
} else {
    $response["status"] = "EMPTY";
}

echo json_encode($response);
