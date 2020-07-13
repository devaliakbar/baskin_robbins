<?php
require 'db/db.php';
require 'middleware/middleware.php';
require 'utility/mysql_escape.php';
require 'db/table/user.php';
require 'db/table/jwt_token.php';

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

if ($id == "") {
    $response["status"] = "FIELD";
    echo json_encode($response);
    die();
}

$DeleteUserQuery = "DELETE
FROM
" . User::$TABLE_NAME . "
WHERE
" . User::$ID . " = '" . $id . "'";

if (mysqli_query($conn, $DeleteUserQuery)) {
    $response["success"] = true;
    //DELETING ALL PREVIOUS TOKEN OF THIS USER
    $DeleteTokenQuery = "DELETE
    FROM
    " . JWTToken::$TABLE_NAME . "
    WHERE
    " . JWTToken::$COLUMN_USER_ID . " = '" . $id . "'";
    mysqli_query($conn, $DeleteTokenQuery);
} else {
    $response["status"] = "FAILED";
}

echo json_encode($response);
