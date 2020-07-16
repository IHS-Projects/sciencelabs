<?php
require_once '../db.php';
require_once '../checkSession.php';
require_once '../PHPSpreadsheet/vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Reader\Xlsx;

$path = "../backupcsv/";
$inputFileName = $path . basename($_FILES["uploadfile"]["name"]);

move_uploaded_file($_FILES["uploadfile"]["tmp_name"], $inputFileName);

$sheetNames = ["Students", "Teachers", "Items"];

$inputFileType = \PhpOffice\PhpSpreadsheet\IOFactory::identify($inputFileName);
$reader = \PhpOffice\PhpSpreadsheet\IOFactory::createReader($inputFileType);
$spreadsheet = $reader->load($inputFileName);

$students = $spreadsheet->getSheet(0)->toArray();

foreach ($students as $student) {
    $array = array();
    foreach ($student as $data) {
        array_push($array, $data);
    }
    $sql = "select id from class where class_name = '" . $array(2) . "';";
    $class = $conn->query($sql)->fetch_assoc(['id']);

    $sql = "insert into student('student_name', 'id', 'class_id') values ('" . $array(0) . "', " . $array(1) . ", " . $class . ")";
    $conn->query($sql);
}

$teachers = $spreadsheet->getSheet(1)->toArray();

foreach ($teachers as $teacher) {
    $array = array();
    foreach ($teacher as $data) {
        array_push($array, $data);
    }
    $sql = "insert into teacher('teacher_name', 'email', 'levels') values ('" . $array(0) . "', '" . $array(1) . "', " . $array(2) . ")";
    $conn->query($sql);
}

$items = $spreadsheet->getSheet(2)->toArray();

foreach ($items as $item) {
    $array = array();
    foreach ($item as $data) {
        array_push($array, $data);
    }
    $sql = "insert into teacher('item_name', 'lab_location', 'specs', 'min_quantity', 'quantity', 'price', 'lab') values ('" .
        $array(0) . "', '" . $array(1) . "', '" . $array(2) . "', " . $array(3) . ", " . $array(4) . ", " . $array(5) . ", '" . $array(6) . "')";
    $conn->query($sql);
}
