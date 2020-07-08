<?php
$conn = mysqli_connect("localhost", "root", "", "baskin_robbins");
if (!$conn) {
    mysqli_error();
    die();
}
