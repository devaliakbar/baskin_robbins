<?php
require 'db/db.php';
require 'middleware/middleware.php';
require 'db/table/jwt_token.php';

$user = Middleware::verifyToken();

//CREATING RESPONCE FORMAT
$response = array();
$response["success"] = false;
$response["status"] = "INVALID";

//DELETING TOKEN
$DeleteTokenQuery = "DELETE
 FROM
 " . JWTToken::$TABLE_NAME . "
 WHERE
 " . JWTToken::$COLUMN_TOKEN . " = '" . $user['token'] . "'";
if (mysqli_query($conn, $DeleteTokenQuery)) {
    $response["success"] = true;
} else {
    $response["status"] = "FAILED";
}

echo json_encode($response);
