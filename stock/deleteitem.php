<?php 
require_once '../db.php';
require_once '../checksession.php';

if ($_SESSION['level'] < 2 && isset($_SESSION['level'])) {
	$item_id = $_GET['item_id'];
	$sql = 'delete from `item` where `id` = ' . $item_id . ';';
	$conn->query($sql);
} else {
	echo '<script>alert("You do not have access to perform this action.");</script>';
}
echo '<script>document.location.href = "../stock/";</script>';
$conn->close();
?>