<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
require_once '../db.php';

$student = $_GET['student'];
$item = $_GET['item'];
$quantity = $_GET['quantity'];

$sql = "update student_checkout set returned=1 where student_id=" . $student . " and item_id=" . $item . " and quantity=" . $quantity . " and lab='" . $_SESSION['lab'] . "';";
$conn->query($sql);