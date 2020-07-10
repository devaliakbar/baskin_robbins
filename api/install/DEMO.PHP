<?php
require '../db/db.php';

mysqli_query($conn, "INSERT INTO tb_typehead_helper(
    col_region,
    col_location,
    col_parlor
)
VALUES('KERALA', 'ERNAKULAM', 'KOCHI')");

mysqli_query($conn, "INSERT INTO tb_typehead_helper(
    col_region,
    col_location,
    col_parlor
)
VALUES('KERALA', 'ERNAKULAM', 'ALUVA')");

mysqli_query($conn, "INSERT INTO tb_typehead_helper(
    col_region,
    col_location,
    col_parlor
)
VALUES('KERALA', 'ERNAKULAM', 'EDAPALLY')");

mysqli_query($conn, "INSERT INTO tb_typehead_helper(
    col_region,
    col_location,
    col_parlor
)
VALUES('KERALA', 'ERNAKULAM', 'VYTTILA')");

mysqli_query($conn, "INSERT INTO tb_typehead_helper(
    col_region,
    col_location,
    col_parlor
)
VALUES('KERALA', 'IDUKKI', 'KOLUKKUMALA')");

mysqli_query($conn, "INSERT INTO tb_typehead_helper(
    col_region,
    col_location,
    col_parlor
)
VALUES('KERALA', 'IDUKKI', 'MUNNAR')");

mysqli_query($conn, "INSERT INTO tb_typehead_helper(
    col_region,
    col_location,
    col_parlor
)
VALUES('KERALA', 'IDUKKI', 'TOOKKUPALAM')");

mysqli_query($conn, "INSERT INTO tb_typehead_helper(
    col_region,
    col_location,
    col_parlor
)
VALUES('TAMIL NADU', 'MADRAS', 'BOSS')");

mysqli_query($conn, "INSERT INTO tb_typehead_helper(
    col_region,
    col_location,
    col_parlor
)
VALUES('TAMIL NADU', 'MADRAS', 'COS')");

mysqli_query($conn, "INSERT INTO tb_typehead_helper(
    col_region,
    col_location,
    col_parlor
)
VALUES('TAMIL NADU', 'POLLACHI', 'SIN')");

mysqli_query($conn, "INSERT INTO tb_typehead_helper(
    col_region,
    col_location,
    col_parlor
)
VALUES('TAMIL NADU', 'POLLACHI', 'TAN')");
