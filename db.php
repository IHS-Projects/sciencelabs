<?php
$servername = '10.0.0.7';
$username = 'labs_user';
$password = 'hello_world';
$dbname = 'labs';

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
	die("Connection failed: " . $conn->connect_error);
}
