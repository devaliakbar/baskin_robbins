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
if ($user['type'] != 0) {
    $response["status"] = "ACCESS";
    echo json_encode($response);
    die();
}

//GETTING BODY VARIABLES
$body = new MySqlEscape(json_decode(file_get_contents('php://input'), true), $conn);

$date = $body->getValue('date');
$name = $body->getValue('name');
$amount = $body->getValue('amount');

//IF THESE VARIABLES ARE EMPTY KILL THE REQUEST
if ($date == "" || $amount == "") {
    $response["status"] = "FIELD";
    echo json_encode($response);
    die();
}

$description = $body->getValue('description');

$InsertExpenseQuery = "INSERT INTO " . Expense::$TABLE_NAME . "(
    " . Expense::$COLUMN_DATE . " ,
    " . Expense::$COLUMN_NAME . " ,
    " . Expense::$COLUMN_DESCRIPTION . " ,
    " . Expense::$COLUMN_AMOUNT . "
)
VALUES(
    '" . $date . "',
    '" . $body->passForSafeSql($name) . "',
    '" . $body->passForSafeSql($description) . "',
    '" . $amount . "'
)";

if (mysqli_query($conn, $InsertExpenseQuery)) {
    $response["success"] = true;
} else {
    $response["status"] = "FAILED";
}

echo json_encode($response);
