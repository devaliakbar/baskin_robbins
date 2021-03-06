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

$username = $body->getValue('username');
$password = $body->getValue('password');

if ($username == "") {
    $response["status"] = "FIELD";
    echo json_encode($response);
    die();
}

if (strlen($password) < 6 || strlen($password) > 50) {
    $response["status"] = "PASSWORD_LENGTH";
    echo json_encode($response);
    die();
}

$UpdatePasswordQuery = "UPDATE
" . User::$TABLE_NAME . "
SET
" . User::$COLUMN_PASSWORD . " =  MD5('" . $body->passForSafeSql($password) . "')
WHERE
" . User::$COLUMN_USERNAME . " = '" . $body->passForSafeSql($username) . "'";

if (mysqli_query($conn, $UpdatePasswordQuery)) {
//DELETING ALL PREVIOUS TOKEN OF THIS USER

//GETTING USER ID
    $GetUserIdQuery = "SELECT
    " . User::$ID . "
    FROM
    " . User::$TABLE_NAME . "
    WHERE
    " . User::$COLUMN_USERNAME . " = '" . $body->passForSafeSql($username) . "'";

    $userResult = mysqli_query($conn, $GetUserIdQuery);

    if (mysqli_num_rows($userResult) > 0) {
        $userInfo = mysqli_fetch_assoc($userResult);
        $userId = $userInfo[User::$ID];
        $response["success"] = true;

        //DELETING ALL TOKEN
        $DeleteTokenQuery = "DELETE
        FROM
        " . JWTToken::$TABLE_NAME . "
        WHERE
        " . JWTToken::$COLUMN_USER_ID . " = '" . $userId . "'";
        mysqli_query($conn, $DeleteTokenQuery);

    } else {
        $response["status"] = "NON_USER";
    }
} else {
    $response["status"] = "FAILED";
}

echo json_encode($response);
