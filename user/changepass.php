<?php require_once '../db.php'; ?>
<?php include '../navbar.php'; ?>
<html>

<head>
	<link rel="stylesheet" href="../css/bootstrap.min.css">
	<script src="../js/jquery-3.4.1.min.js"></script>
	<script src="../js/popper.min.js"></script>
	<script src="../js/bootstrap.min.js"></script>
</head>

<body>
	<?php
	if ($_SERVER["REQUEST_METHOD"] == "POST") {
		global $conn;

		$name = $_REQUEST['user'];
		$oldpass = $_REQUEST['oldpass'];
		$newpass = $_REQUEST['newpass'];
		$confpass = $_REQUEST['confirmpass'];

		if (strcmp($newpass, $confpass) == 0) {
			$sql = 'select * from teacher where teacher_name="' . $name . '";';

			$result = $conn->query($sql);
			if ($result->num_rows > 0) {
				while ($row = $result->fetch_assoc()) {
					$dbname = $row["teacher_name"];
					$dbpass = $row["teacher_pass"];

					if (strcmp($oldpass, $dbpass) == 0) {
						if (strcmp($name, $dbname) == 0) {
							$sql = 'update teacher set teacher_pass="' . $newpass . '" where teacher_name="' . $name . '";';
							$conn->query($sql);
							echo '<script>alert("Password Successfully Changed");document.location.href="../home";</script>';
						}
					} else {
						echo '<script>alert("Old Passwords Do Not Match");</script>';
					}
				}
			} else {
				echo '<script>alert("Username Not Found");</script>';
			}
		} else {
			echo '<script>alert("New Passwords Do Not Match");</script>';
			$_SERVER["REQUEST_METHOD"] == "";
		}
	}
	?>

	<script>
		function back() {
			document.location.href = '../home';
		}
	</script>

	<div class="container-fluid">
		<br>
		<br>
		<div class="row">
			<div class="col-sm-4"></div>
			<div class="col-sm-4 bg-white" align="center">
				<form action="<?php $_SERVER = ["PHP_SELF"] ?>" method="POST">
					<div align="center">
						<div class="btn-group btn-large">
							<h3>Change Password</h3>
						</div>
						<div class="float-right"><img src="../img/Technology Elements/joystick.svg" height="50" width="50" align="center" border="0" alt="Icon"></div>
					</div>
					<div align="center">
						<table class="table">
							<tr>
								<td>
									<label class="form-control input-sm text-primary" align="center"><b>Username</b></label>
								<td>
									<input class="form-control input-sm" type="text" placeholder="Enter Username" name="user" autofocus required></input>
							<tr>
								<td>
									<label class="form-control input-sm text-primary" align="center"><b>Old Password</b></label>
								<td>
									<input class="form-control input-sm" type="password" placeholder="Enter Old Password" name="oldpass" required></input>
							<tr>
								<td>
									<label class="form-control input-sm text-primary" align="center"><b>New Password</b></label>
								<td>
									<input class="form-control input-sm" type="password" placeholder="Enter New Password" name="newpass" required></input>
							<tr>
								<td>
									<label class="form-control input-sm text-primary" align="center"><b>Confirm Password</b></label>
								<td>
									<input class="form-control input-sm" type="password" placeholder="Enter New Password" name="confirmpass" required></input>
							<tr>
								<td colspan="2">
									<button class="btn btn-warning btn-block" type="submit">Change</button>
							<tr>
								<td colspan="2">
									<button class="btn btn-light btn-block" onclick="back()">Cancel</button>
						</table>
					</div>
				</form>
			</div>
		</div>
	</div>
</body>

</html>