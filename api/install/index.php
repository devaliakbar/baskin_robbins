<?php
require '../db/db.php';
require '../db/table/user.php';
require '../db/table/jwt_token.php';
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
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
