<html>

<head>
	<link rel="stylesheet" href="css/bootstrap.min.css">
	<script src="js/bootstrap.min.js"></script>
</head>

<body>
	<?php
	if (session_status() == PHP_SESSION_NONE) {
		session_start();
	}
	?>
	<script>
		function changepass() {
			document.location.href = 'user/changepass.php';
		}
	</script>
	<!-- hi ->
	<div class="container-fluid">
		<br>
		<br>
		<div class="row">
			<div class="col-sm-4"></div>
			<div class="col-sm-4 bg-white" align="center">
				<form action="user/validateuser.php" method="POST">
					<div align="center">
						<div class="btn-group btn-group-lg">
							<h2>Login</h2>
						</div>
						<div class="float-right"><img src="img/Mad Science/017-mad-scientist.svg" height="50" width="50" align="center" border="0" alt="Icon"></div>
					</div>
					<div align="center">
						<table class="table">
							<tr>
								<td>
									<label class="form-control input-sm text-primary"><b>Username</b></label>
								<td>
									<input class="form-control input-sm" type="text" placeholder="Enter Username" name="user" autofocus required></input>
							<tr>
								<td>
									<label class="form-control input-sm text-primary"><b>Password</b></label>
								<td>
									<input class="form-control input-sm" type="password" placeholder="Enter Password" name="pass" required></input>
							<tr>
								<td colspan="2">
									<button class="btn btn-success btn-block" type="submit">Login</button>
							<tr>
								<td colspan="2">
									<button class="btn btn-warning btn-block" onclick="changepass()">Change Password</button>
						</table>
					</div>
				</form>
			</div>
		</div>
	</div>
</body>

</html>
