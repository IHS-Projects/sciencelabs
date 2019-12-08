<html>

<head>
	<link rel="stylesheet" href="../css/bootstrap.min.css">
	<script src="../js/jquery-3.4.1.min.js"></script>
	<script src="../js/popper.min.js"></script>
	<script src="../js/bootstrap.min.js"></script>
</head>

<body>

	<?php include '../navbar.php'; ?>
	<script>
		setActive('Stock');
	</script>

	<br><br>
	<?php
	if (!isset($_SESSION)) {
		if (session_status() == PHP_SESSION_NONE) {
			session_start();
		}
	}
	if ($_SESSION['level'] == 2 || !isset($_SESSION['level'])) {
		echo '<script>alert("You do not have access to perform this action.");document.location.href = "../stock/";</script>';
	}
	?>

	<script>
		function back() {
			document.location.href = '../stock/';
		}
	</script>

	<div class="row">
		<div class="col-sm-4"></div>

		<div class="col-sm-4">
			<h1 class="text-center">Add New Item</h1>

			<form id="editForm" action="additem.php" method="POST">
				<table class="table">
					<tr>
						<div class="form-group">
							<td><label for="name" class="form-control input-sm text-primary"><b>Item Name</b><label>
							<td><input type="text" class="form-control" name="itemname" required>
						</div>

					<tr>
						<div class="form-group">
							<td><label for="loc" class="form-control input-sm text-primary"><b>Shelf No.</b><label>
							<td><input type="number" class="form-control" name="itemloc" required>
						</div>

					<tr>
						<div class="form-group">
							<td><label for="specs" class="form-control input-sm text-primary"><b>Specifications</b><label>
							<td><textarea class="form-control" name="itemspecs" form="editForm" required></textarea>
						</div>
				</table>

				<button type="submit" class="btn btn-success btn-block">Add Item</button>
			</form>
			<button name='button' class="btn btn-light btn-block" onclick='back()'>Cancel</button>
		</div>
		<div class="col-sm-4"></div>
	</div>
</body>

</html>