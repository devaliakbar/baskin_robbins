<?php
require 'db/db.php';
require 'middleware/middleware.php';
require 'utility/mysql_escape.php';
require 'db/table/expense.php';

$user = Middleware::verifyToken();

//CREATING RESPONCE FORMAT
$response = array();
$response["success"] = false;
$response["status"] = "INVALID";

//IF USER IS NOT ADMIN KILL REQUEST
if ($user['type'] == 2) {
    $response["status"] = "ACCESS";
    echo json_encode($response);
    die();
}

//GETTING BODY VARIABLES
$body = new MySqlEscape(json_decode(file_get_contents('php://input'), true), $conn);

$id = $body->getValue('id');
$date = $body->getValue('date');
$name = $body->getValue('name');
$amount = $body->getValue('amount');

//IF THESE VARIABLES ARE EMPTY KILL THE REQUEST
if ($id == "" || $date == "" || $amount == "") {
    $response["status"] = "FIELD";
    echo json_encode($response);
    die();
}

$description = $body->getValue('description');

$UpdateExpenseQuery = "UPDATE
" . Expense::$TABLE_NAME . "
SET
" . Expense::$COLUMN_DATE . " = '" . $body->passForSafeSql($date) . "',
" . Expense::$COLUMN_NAME . " = '" . $body->passForSafeSql($name) . "',
" . Expense::$COLUMN_DESCRIPTION . " = '" . $body->passForSafeSql($description) . "',
" . Expense::$COLUMN_AMOUNT . " = '" . $body->passForSafeSql($amount) . "'
WHERE
_id = '" . $id . "'";

if (mysqli_query($conn, $UpdateExpenseQuery)) {
    $response["success"] = true;
} else {
    $response["status"] = "FAILED";
}

echo json_encode($response);
