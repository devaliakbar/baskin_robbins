<?php
require 'db/db.php';
require 'db/table/user.php';
require 'jwt/jwt_helper.php';
require 'utility/mysql_escape.php';

//GETTING BODY VARIABLES
$body = new MySqlEscape(json_decode(file_get_contents('php://input'), true), $conn);

$username = $body->getValue('username');
$password = $body->getValue('password');

//CREATING RESPONCE FORMAT
$response = array();
$response["success"] = false;
$response["status"] = "INVALID";

$validateUserQuery = "SELECT
" . User::$ID . "
FROM
" . User::$TABLE_NAME . "
WHERE
" . User::$COLUMN_USERNAME . " = '" . $username . "' AND " . User::$COLUMN_PASSWORD . " = MD5('" . $password . "')";

$validateUserResult = mysqli_query($conn, $validateUserQuery);

if (mysqli_num_rows($validateUserResult) > 0) {
    $userInfo = mysqli_fetch_assoc($validateUserResult);
    $userId = $userInfo[User::$ID];

    $jwtToken = JWTHelper::createToken($userId);

    if ($jwtToken != null) {
        $response["token"] = $jwtToken;
        $response["success"] = true;
    } else {
        $response["status"] = "FAILED";
    }

} else {
    $response["status"] = "USER";
}

echo json_encode($response);
