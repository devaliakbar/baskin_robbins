<?php
require '../db/db.php';
require '../db/table/user.php';
require '../db/table/jwt_token.php';
require '../db/table/camera_details.php';
require '../db/table/dvr_details.php';
require '../db/table/network_cable_details.php';
require '../db/table/tv_details.php';
require '../db/table/vistited_details.php';
require '../db/table/typehead_help.php';
require '../db/table/expense.php';
require '../jwt/jwt_helper.php';

////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
// CHECKING ALREADY INSTALLED
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
$UserTableExistCheck = mysqli_query($conn, "SELECT 1 FROM " . User::$TABLE_NAME . " LIMIT 1");
if ($UserTableExistCheck == true) {
    echo "Already Installed";
    die();
}

////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
// CREATING USER TABLE
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
$UserTableCreateQuery = "CREATE TABLE IF NOT EXISTS " . User::$TABLE_NAME . " (
    " . User::$ID . " BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY ,
    " . User::$COLUMN_NAME . " VARCHAR(100) ,
    " . User::$COLUMN_USERNAME . " VARCHAR(100) UNIQUE ,
    " . User::$COLUMN_PASSWORD . " VARCHAR(100) ,
    " . User::$COLUMN_TYPE . " INT
)ENGINE = INNODB;";
/********** COLUMN_TYPE =  0 : All Privileges , 1 : Edit Privilege , 2 : Only View Privilege ************ */

if (mysqli_query($conn, $UserTableCreateQuery)) {
    echo "<br>Table 'User' created successfully<br>";
} else {
    echo "<br>Error creating table 'User' : " . mysqli_error($conn) . "<br>";
}

////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
// CREATING JWT TOKEN TABLE
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
$JWTTokenTableCreateQuery = "CREATE TABLE IF NOT EXISTS " . JWTToken::$TABLE_NAME . " (
    " . JWTToken::$ID . " BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY ,
    " . JWTToken::$COLUMN_USER_ID . " BIGINT ,
    " . JWTToken::$COLUMN_TOKEN . " VARCHAR(1000)
)ENGINE = INNODB;";

if (mysqli_query($conn, $JWTTokenTableCreateQuery)) {
    echo "<br>Table 'JWT_TOKEN' created successfully<br>";
} else {
    echo "<br>Error creating table 'JWT_TOKEN' : " . mysqli_error($conn) . "<br>";
}

////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
// CREATING CAMERA DETAILS TABLE
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
$CameraDetailsTableCreateQuery = "CREATE TABLE IF NOT EXISTS " . CameraDetails::$TABLE_NAME . " (
    " . CameraDetails::$ID . " BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY ,
    " . CameraDetails::$COLUMN_VISITED_ID . " BIGINT UNSIGNED ,

    " . CameraDetails::$COLUMN_TYPE . " VARCHAR(50),
    " . CameraDetails::$COLUMN_BRAND . " VARCHAR(50),
    " . CameraDetails::$COLUMN_COUNT . " INT ,
    " . CameraDetails::$COLUMN_STATUS . " VARCHAR(50),
    " . CameraDetails::$COLUMN_REMARK . " VARCHAR(250),
    " . CameraDetails::$COLUMN_IP_DETAIL . " VARCHAR(250),
    " . CameraDetails::$COLUMN_SUGGESTION . " VARCHAR(250)
)ENGINE = INNODB;";

if (mysqli_query($conn, $CameraDetailsTableCreateQuery)) {
    echo "<br>Table 'CAMERA_DETAILS' created successfully<br>";
} else {
    echo "<br>Error creating table 'CAMERA_DETAILS' : " . mysqli_error($conn) . "<br>";
}

////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
// CREATING DVR DETAILS TABLE
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
$DVRDetailsTableCreateQuery = "CREATE TABLE IF NOT EXISTS " . DVRDetails::$TABLE_NAME . " (
    " . DVRDetails::$ID . " BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY ,
    " . DVRDetails::$COLUMN_VISITED_ID . " BIGINT UNSIGNED ,

    " . DVRDetails::$COLUMN_NO_CHANNELS . " INT,
    " . DVRDetails::$COLUMN_BRAND . " VARCHAR(50),
    " . DVRDetails::$COLUMN_RECORDING_AVAILABILITY . " VARCHAR(50) ,
    " . DVRDetails::$COLUMN_HDD_CAPACITY . " VARCHAR(50),
    " . DVRDetails::$COLUMN_REMARK . " VARCHAR(250),
    " . DVRDetails::$COLUMN_SUGGESTION . " VARCHAR(250)
)ENGINE = INNODB;";

if (mysqli_query($conn, $DVRDetailsTableCreateQuery)) {
    echo "<br>Table 'DVR_DETAILS' created successfully<br>";
} else {
    echo "<br>Error creating table 'DVR_DETAILS' : " . mysqli_error($conn) . "<br>";
}

////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
// CREATING NETWORK CABLE DETAILS TABLE
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
$NetworkCableDetailsTableCreateQuery = "CREATE TABLE IF NOT EXISTS " . NetworkCableDetails::$TABLE_NAME . " (
    " . NetworkCableDetails::$ID . " BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY ,
    " . NetworkCableDetails::$COLUMN_VISITED_ID . " BIGINT UNSIGNED ,

    " . NetworkCableDetails::$COLUMN_NETWORK_POINT . " VARCHAR(50),
    " . NetworkCableDetails::$COLUMN_STATUS . " VARCHAR(50),
    " . NetworkCableDetails::$COLUMN_SUGGESTION . " VARCHAR(250)
)ENGINE = INNODB;";

if (mysqli_query($conn, $NetworkCableDetailsTableCreateQuery)) {
    echo "<br>Table 'NETWORK_CABLE_DETAILS' created successfully<br>";
} else {
    echo "<br>Error creating table 'NETWORK_CABLE_DETAILS' : " . mysqli_error($conn) . "<br>";
}

////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
// CREATING TV DETAILS TABLE
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
$TVDetailsTableCreateQuery = "CREATE TABLE IF NOT EXISTS " . TVDetails::$TABLE_NAME . " (
    " . TVDetails::$ID . " BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY ,
    " . TVDetails::$COLUMN_VISITED_ID . " BIGINT UNSIGNED ,

    " . TVDetails::$COLUMN_NETWORK_POINT . " VARCHAR(50),
    " . TVDetails::$COLUMN_STATUS . " VARCHAR(50),
    " . TVDetails::$COLUMN_REMARK . " VARCHAR(250),
    " . TVDetails::$COLUMN_SUGGESTION . " VARCHAR(250)
)ENGINE = INNODB;";

if (mysqli_query($conn, $TVDetailsTableCreateQuery)) {
    echo "<br>Table 'TV_DETAILS' created successfully<br>";
} else {
    echo "<br>Error creating table 'TV_DETAILS' : " . mysqli_error($conn) . "<br>";
}

////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
// CREATING VISITED DETAILS TABLE
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
$VisitedDetailsTableCreateQuery = "CREATE TABLE IF NOT EXISTS " . VisitedDetails::$TABLE_NAME . " (
    " . VisitedDetails::$ID . " BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY ,
    " . VisitedDetails::$COLUMN_DATE . " DATE ,
    " . VisitedDetails::$COLUMN_REGION . " VARCHAR(50),
    " . VisitedDetails::$COLUMN_LOCATION . " VARCHAR(50),
    " . VisitedDetails::$COLUMN_PARLOUR . " VARCHAR(50),
    " . VisitedDetails::$COLUMN_TIME . " VARCHAR(50),
    " . VisitedDetails::$COLUMN_COMMENT . " VARCHAR(250),

    " . VisitedDetails::$COLUMN_VERIFIED_BY . " VARCHAR(50),
    " . VisitedDetails::$COLUMN_VERIFIED_DATE . " DATE ,

    " . VisitedDetails::$COLUMN_CHECKED_BY . " VARCHAR(50),
    " . VisitedDetails::$COLUMN_CHECKED_DATE . " DATE ,

    " . VisitedDetails::$COLUMN_APPROVED_BY . " VARCHAR(50),
    " . VisitedDetails::$COLUMN_APPROVED_DATE . " DATE
)ENGINE = INNODB;";

if (mysqli_query($conn, $VisitedDetailsTableCreateQuery)) {
    echo "<br>Table 'VISITED_DETAILS' created successfully<br>";
} else {
    echo "<br>Error creating table 'VISITED_DETAILS' : " . mysqli_error($conn) . "<br>";
}

////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
// CREATING TYPEHEAD HELPER TABLE
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
$TypeheadHelperTableCreateQuery = "CREATE TABLE IF NOT EXISTS " . TypeheadHelper::$TABLE_NAME . " (
    " . TypeheadHelper::$ID . " BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY ,
    " . TypeheadHelper::$COLUMN_REGION . " VARCHAR(50) ,
    " . TypeheadHelper::$COLUMN_LOCATION . " VARCHAR(50) ,
    " . TypeheadHelper::$COLUMN_PARLOR . " VARCHAR(50)
)ENGINE = INNODB;";

if (mysqli_query($conn, $TypeheadHelperTableCreateQuery)) {
    echo "<br>Table 'TYPEHEAD_HELPER' created successfully<br>";
} else {
    echo "<br>Error creating table 'TYPEHEAD_HELPER' : " . mysqli_error($conn) . "<br>";
}

////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
// CREATING EXPENSE TABLE
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
$ExpenseTableCreateQuery = "CREATE TABLE IF NOT EXISTS " . Expense::$TABLE_NAME . " (
    " . Expense::$ID . " BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY ,
    " . Expense::$COLUMN_DATE . " DATE ,
    " . Expense::$COLUMN_NAME . " VARCHAR(50) ,
    " . Expense::$COLUMN_AMOUNT . " DECIMAL ,
    " . Expense::$COLUMN_DESCRIPTION . " VARCHAR(500)
)ENGINE = INNODB;";

if (mysqli_query($conn, $ExpenseTableCreateQuery)) {
    echo "<br>Table 'EXPENSE' created successfully<br>";
} else {
    echo "<br>Error creating table 'EXPENSE' : " . mysqli_error($conn) . "<br>";
}

////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
// CREATING USERS
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
$AdminCreateQuery = "INSERT INTO " . User::$TABLE_NAME . "(
    " . User::$COLUMN_NAME . " ,
    " . User::$COLUMN_USERNAME . " ,
    " . User::$COLUMN_PASSWORD . " ,
    " . User::$COLUMN_TYPE . "
)
VALUES('Admin' , 'admin' , MD5('password') , 0)";

if (mysqli_query($conn, $AdminCreateQuery)) {
    echo "<br>Successfully Created 'Admin'<br>";
} else {
    echo "<br>Failed To Create 'Admin' : " . mysqli_error($conn) . "<br>";
}
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
$UserCreateQuery = "INSERT INTO " . User::$TABLE_NAME . "(
    " . User::$COLUMN_NAME . " ,
    " . User::$COLUMN_USERNAME . " ,
    " . User::$COLUMN_PASSWORD . " ,
    " . User::$COLUMN_TYPE . "
)
VALUES('User' , 'user' , MD5('password') , 1)";

if (mysqli_query($conn, $UserCreateQuery)) {
    echo "<br>Successfully Created 'User'<br>";
} else {
    echo "<br>Failed To Create 'User' : " . mysqli_error($conn) . "<br>";
}
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
$GuestCreateQuery = "INSERT INTO " . User::$TABLE_NAME . "(
    " . User::$COLUMN_NAME . " ,
    " . User::$COLUMN_USERNAME . " ,
    " . User::$COLUMN_PASSWORD . " ,
    " . User::$COLUMN_TYPE . "
)
VALUES('Guest' , 'guest' , MD5('password') , 2)";

if (mysqli_query($conn, $GuestCreateQuery)) {
    echo "<br>Successfully Created 'Guest'<br>";
} else {
    echo "<br>Failed To Create 'Guest' : " . mysqli_error($conn) . "<br>";
}
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
