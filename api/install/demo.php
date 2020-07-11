
<?php
require '../db/db.php';
mysqli_query($conn, "INSERT INTO tb_typehead_helper(
    col_region,
    col_location,
    col_parlor
)
VALUES('INDIA', 'KERALA', 'ERNAKULAM')");

mysqli_query($conn, "INSERT INTO tb_typehead_helper(
    col_region,
    col_location,
    col_parlor
)
VALUES('INDIA', 'KERALA', 'IDUKKI')");

mysqli_query($conn, "INSERT INTO tb_typehead_helper(
    col_region,
    col_location,
    col_parlor
)
VALUES('INDIA', 'KERALA', 'KANNUR')");

mysqli_query($conn, "INSERT INTO tb_typehead_helper(
    col_region,
    col_location,
    col_parlor
)
VALUES('INDIA', 'KERALA', 'THRISSUR')");

mysqli_query($conn, "INSERT INTO tb_typehead_helper(
    col_region,
    col_location,
    col_parlor
)
VALUES('INDIA', 'TAMIL NADU', 'CHENNAI')");

mysqli_query($conn, "INSERT INTO tb_typehead_helper(
    col_region,
    col_location,
    col_parlor
)
VALUES('INDIA', 'TAMIL NADU', 'POLLACHI')");

mysqli_query($conn, "INSERT INTO tb_typehead_helper(
    col_region,
    col_location,
    col_parlor
)
VALUES('INDIA', 'TAMIL NADU', 'COIMBATOOR')");

mysqli_query($conn, "INSERT INTO tb_typehead_helper(
    col_region,
    col_location,
    col_parlor
)
VALUES('INDIA', 'JAMMU & KASHMIR', 'SRINAGAR')");

mysqli_query($conn, "INSERT INTO tb_typehead_helper(
    col_region,
    col_location,
    col_parlor
)
VALUES('INDIA', 'JAMMU & KASHMIR', 'SONAMERG')");

mysqli_query($conn, "INSERT INTO tb_typehead_helper(
    col_region,
    col_location,
    col_parlor
)
VALUES('CANADA', 'ONTARIO', 'TORRENTO')");

mysqli_query($conn, "INSERT INTO tb_typehead_helper(
    col_region,
    col_location,
    col_parlor
)
VALUES('CANADA', 'ONTARIO', 'CONESTIGO')");

mysqli_query($conn, "INSERT INTO tb_typehead_helper(
    col_region,
    col_location,
    col_parlor
)
VALUES('CANADA', 'NOVA SCOTIA', 'CAPE BRITON')");
?>