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

$fullName = $body->getValue('fullName');
$username = $body->getValue('username');
$password = $body->getValue('password');
$type = $body->getValue('type');

if ($fullName == "" || $username == "") {
    $response["status"] = "FIELD";
    echo json_encode($response);
    die();
}

if (strlen($password) < 6 || strlen($password) > 50) {
    $response["status"] = "PASSWORD_LENGTH";
    echo json_encode($response);
    die();
}

if (!is_numeric($type) || $type > 2 || $type < 0) {
    $response["status"] = "ACCOUNT_TYPE";
    echo json_encode($response);
    die();
}

$CheckUsernameExist = "SELECT
" . User::$ID . "
FROM
" . User::$TABLE_NAME . "
WHERE
" . User::$COLUMN_USERNAME . " = '" . $body->passForSafeSql($username) . "'";

$checkUsernameExistResult = mysqli_query($conn, $CheckUsernameExist);

if (mysqli_num_rows($checkUsernameExistResult) > 0) {
    $response["status"] = "EXIST";
    echo json_encode($response);
    die();
}

$UserCreateQuery = "INSERT INTO " . User::$TABLE_NAME . "(
    " . User::$COLUMN_NAME . " ,
    " . User::$COLUMN_USERNAME . " ,
    " . User::$COLUMN_PASSWORD . " ,
    " . User::$COLUMN_TYPE . "
)
VALUES('" . $body->passForSafeSql($fullName) . "' , '" . $body->passForSafeSql($username) . "' , MD5('" . $body->passForSafeSql($password) . "') , " . $type . ")";

if (mysqli_query($conn, $UserCreateQuery)) {
    $response["success"] = true;
}

echo json_encode($response);
