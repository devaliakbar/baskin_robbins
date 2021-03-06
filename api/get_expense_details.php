<?php
require 'db/db.php';
require 'middleware/middleware.php';
require 'db/table/expense.php';

$user = Middleware::verifyToken();

//CREATING RESPONCE FORMAT
$response = array();
$response["success"] = false;
$response["status"] = "INVALID";

//GETTING EXPENSE ID FOR FETCHING DETAILS
if (!isset($_GET['id'])) {
    $response["status"] = "ID";
    echo json_encode($response);
    die();
}

$id = $_GET['id'];

$Query = "SELECT * FROM " . Expense::$TABLE_NAME . " WHERE " . Expense::$ID . " = '" . $id . "'";

$result = mysqli_query($conn, $Query);

if (mysqli_num_rows($result) > 0) {
    $response["success"] = true;
    $temp = array();

    $row = mysqli_fetch_assoc($result);
    $temp['id'] = $row[Expense::$ID];
    $temp['date'] = $row[Expense::$COLUMN_DATE];
    $temp['name'] = $row[Expense::$COLUMN_NAME];
    $temp['description'] = $row[Expense::$COLUMN_DESCRIPTION];
    $temp['amount'] = $row[Expense::$COLUMN_AMOUNT];

    $response["expense_details"] = $temp;
} else {
    $response["status"] = "EMPTY";
}

echo json_encode($response);
