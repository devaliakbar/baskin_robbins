<?php
require 'db/db.php';
require 'middleware/middleware.php';
require 'db/table/expense.php';

$user = Middleware::verifyToken();

//CREATING RESPONCE FORMAT
$response = array();
$response["success"] = false;
$response["status"] = "INVALID";

$Query = "SELECT * FROM " . Expense::$TABLE_NAME . " WHERE 1";

if (isset($_GET['date'])) {
    $Query = $Query . " AND " . Expense::$COLUMN_DATE . " = '" . $_GET['date'] . "'";
}

if (isset($_GET['name'])) {
    $Query = $Query . " AND " . Expense::$COLUMN_NAME . " LIKE '" . $_GET['name'] . "%'";
}

$result = mysqli_query($conn, $Query);

if (mysqli_num_rows($result) > 0) {
    $response["success"] = true;
    $temp = array();
    $cursorArray = array();

    while ($row = mysqli_fetch_assoc($result)) {
        $temp['id'] = $row[Expense::$ID];
        $temp['date'] = $row[Expense::$COLUMN_DATE];
        $temp['name'] = $row[Expense::$COLUMN_NAME];
        $temp['description'] = $row[Expense::$COLUMN_DESCRIPTION];
        $temp['amount'] = $row[Expense::$COLUMN_AMOUNT];
        array_push($cursorArray, $temp);
    }
    $response["expenses"] = $cursorArray;
} else {
    $response["status"] = "EMPTY";
}

echo json_encode($response);
