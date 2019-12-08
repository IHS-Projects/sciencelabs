<?php require_once '../db.php'; ?>
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

	<script>
		function back() {
			document.location.href = '../stock/';
		}
	</script>

	<?php
	if (session_status() == PHP_SESSION_NONE) {
		session_start();
	}
	global $conn;

	if ($_SESSION['level'] == 2 || !isset($_SESSION['level'])) {
		echo '<script>alert("You do not have access to perform this action.");document.location.href = "../stock/";</script>';
	}

	$item_id = $_GET['item_id'];

	$sql = 'SELECT * from item WHERE id=' . $item_id . ';';
	$result = $conn->query($sql);

	if ($result->num_rows == 1) {
		$row = $result->fetch_assoc();
		$item_name = $row['item_name'];
		$item_stock = $row['quantity'];
		$item_loc = $row['lab_location'];
		$item_specs = $row['specs'];
	}
	$conn->close();
	?>

	<script>
		document.title = '<?php echo $item_name ?> - PhyLab';
	</script>
	<br>
	<br>

	<div class="row">
		<div class="col-sm-4"></div>

		<div class="col-sm-4">
			<h1 class="text-center">Edit Item</h1>
			<form id="editForm" action="edititem.php" method="POST">
				<input type="hidden" class="form-control" name="itemid" value="<?php echo $item_id; ?>" required>

				<table class="table">
					<tr>
						<div class="form-group">
							<td><label for="name" class="form-control input-sm text-primary"><b>Item Name</b><label>
							<td><input type="text" class="form-control" name="itemname" value="<?php echo $item_name; ?>" required>
						</div>

					<tr>
						<div class="form-group">
							<td><label for="stock" class="form-control input-sm text-primary"><b>Item Quantity</b><label>
							<td><input type="number" class="form-control" name="itemstock" value="<?php echo $item_stock; ?>" readonly required>
						</div>

					<tr>
						<div class="form-group">
							<td><label for="loc" class="form-control input-sm text-primary"><b>Shelf No.</b><label>
							<td><input type="number" class="form-control" name="itemloc" value="<?php echo $item_loc; ?>" required>
						</div>

					<tr>
						<div class="form-group">
							<td><label for="specs" class="form-control input-sm text-primary"><b>Specifications</b><label>
							<td><textarea class="form-control" name="itemspecs" form="editForm"><?php echo $item_specs ?></textarea>
						</div>
				</table>

				<button type="submit" class="btn btn-warning btn-block">Edit</button>
			</form>
			<button name='button' class="btn btn-light btn-block" onclick='back()'>Cancel</button>
		</div>

		<div class="col-sm-4"></div>
	</div>
</body>

</html>