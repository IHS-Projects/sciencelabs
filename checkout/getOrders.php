<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

require_once '../db.php';

$sql = 'select * from student_checkout where lab="' . $_SESSION['lab'] . '" and returned=0;';
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $var = 0;
    while ($row = $result->fetch_assoc()) {
        $sql = 'select * from student where id=' . $row['student_id'] . ';';
        $student = $conn->query($sql);
        $student = $student->fetch_assoc()['student_name'];

        $sql = 'select * from item where id=' . $row['item_id'] . ';';
        $item = $conn->query($sql);
        $item = $item->fetch_assoc()['item_name'];

        echo '<tr id="row' . $var . '">' .
            '<td id="' . $row['student_id'] . '">' . $student .
            '<td id="' . $row['item_id'] . '">' . $item .
            '<td>' . $row['quantity'] .
            '<td>' . $row['checkout_date'] .
            '<td><button class="btn btn-warning btn-sm" onclick="arrived(' . $var . ')">Returned</button>';
        $var++;
    }
}
