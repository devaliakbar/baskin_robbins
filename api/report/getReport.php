<?php
error_reporting(E_ERROR | E_PARSE);
include '../db/db.php';

require_once 'phpexcel/Classes/PHPExcel.php';

$objPHPExcel = new PHPExcel();

$sheet = $objPHPExcel->getActiveSheet();

$objWorkSheet = $objPHPExcel->createSheet(0);

$objWorkSheet->setTitle('Summary');
$objWorkSheet->getColumnDimension("A")->setAutoSize(true);
$objWorkSheet->getColumnDimension("B")->setAutoSize(true);
$objWorkSheet->getColumnDimension("C")->setAutoSize(true);
$objWorkSheet->getColumnDimension("D")->setAutoSize(true);
$objWorkSheet->getColumnDimension("E")->setAutoSize(true);
$objWorkSheet->getStyle("A1:E1")->getFont()->setBold(true);

$objWorkSheet->setCellValue('A1', 'From Date');
$objWorkSheet->setCellValue('B1', 'To Date');
$objWorkSheet->setCellValue('C1', 'Region');
$objWorkSheet->setCellValue('D1', 'Location');
$objWorkSheet->setCellValue('E1', 'Parlor');

$startDate = "";
$endDate = "";
$regionName = "";
$location = "";
$parlor = "";

if (isset($_GET['from_date'])) {
    $startDate = $_GET['from_date'];
    if (isset($_GET['to_date'])) {
        $endDate = $_GET['to_date'];
    }
}

if (isset($_GET['region'])) {
    $regionName = $_GET['region'];
}

if (isset($_GET['location'])) {
    $location = $_GET['location'];
}

if (isset($_GET['parlor'])) {
    $parlor = $_GET['parlor'];
}

$objWorkSheet->setCellValue('A2', $startDate);
$objWorkSheet->setCellValue('B2', $endDate);
$objWorkSheet->setCellValue('C2', $regionName);
$objWorkSheet->setCellValue('D2', $location);
$objWorkSheet->setCellValue('E2', $parlor);

$query = "SELECT
tb_dvr_details._id
FROM
tb_visited_details
INNER JOIN tb_dvr_details ON tb_visited_details._id = tb_dvr_details.col_visited_id  WHERE 1";

if ($startDate != "") {
    if ($endDate != "") {
        $query = $query . " AND tb_visited_details.col_date BETWEEN '" . $startDate . "' AND '" . $endDate . "'";
    } else {
        $query = $query . " AND tb_visited_details.col_date = '" . $startDate . "'";
    }
}

if ($regionName != "") {
    $query = $query . " AND tb_visited_details.col_region = '" . $regionName . "'";
}

if ($location != "") {
    $query = $query . " AND tb_visited_details.col_location = '" . $location . "'";
}

if ($parlor != "") {
    $query = $query . " AND tb_visited_details.col_parlour = '" . $parlor . "'";
}

$result = mysqli_query($conn, $query);
$hardDiskCount = mysqli_num_rows($result);

$query = "SELECT
tv_details._id
FROM
tb_visited_details
INNER JOIN tv_details ON tb_visited_details._id = tv_details.col_visited_id WHERE 1";

if ($startDate != "") {
    if ($endDate != "") {
        $query = $query . " AND tb_visited_details.col_date BETWEEN '" . $startDate . "' AND '" . $endDate . "'";
    } else {
        $query = $query . " AND tb_visited_details.col_date = '" . $startDate . "'";
    }
}

if ($regionName != "") {
    $query = $query . " AND tb_visited_details.col_region = '" . $regionName . "'";
}

if ($location != "") {
    $query = $query . " AND tb_visited_details.col_location = '" . $location . "'";
}

if ($parlor != "") {
    $query = $query . " AND tb_visited_details.col_parlour = '" . $parlor . "'";
}

$result = mysqli_query($conn, $query);
$tvCount = mysqli_num_rows($result);

$objWorkSheet->getStyle("A4:B4")->getFont()->setBold(true);
$objWorkSheet->setCellValue('A4', "Hard Disk Count");
$objWorkSheet->setCellValue('B4', "TV Count");

$objWorkSheet->setCellValue('A5', $hardDiskCount);
$objWorkSheet->setCellValue('B5', $tvCount);

$queryForFechingCameraCounts = "SELECT
tb_camera_details._id
FROM
tb_visited_details
INNER JOIN tb_camera_details ON tb_visited_details._id = tb_camera_details.col_visited_id";

//FILE NAME
$FILENAME = "report";

header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="' . $FILENAME . '.xlsx"');
header('Cache-Control: max-age=0');
$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
$objWriter->save('php://output');
