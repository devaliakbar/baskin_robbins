<?php
// $conn = mysqli_connect("localhost", "mypreicom_baskin", "baskin", "mypreicom_baskin");
$conn = mysqli_connect("localhost", "root", "", "baskin_robbins");
if (!$conn) {
    mysqli_error();
    die();
}
