<html>

<head>
	<link rel="stylesheet" href="../css/bootstrap.min.css">
	<script src="../js/jquery-3.4.1.min.js"></script>
	<script src="../js/popper.min.js"></script>
	<script src="../js/bootstrap.min.js"></script>

	<style>
		input[type=number]::-webkit-inner-spin-button,
		input[type=number]::-webkit-outer-spin-button {
			-webkit-appearance: none;
			margin: 0;
		}

		#studentname,
		#itemname {
			max-height: 150px;
			overflow-y: scroll;
		}
	</style>
</head>

<body>
	<?php include '../navbar.php'; ?>
	<script>
		setActive('Bookings');
	</script>

	<div class="container-fluid">
		<br>
		<div class="text-center">
			<button class="btn btn-primary" onclick="document.location.href='addexp.php?bookingid=<?php echo $_GET['bookingid'] ?>';">New Experiment</button>
		</div>
		<br>
		<div class="row">
			<div class="col-sm-6 bg-white" align="center">
				<form action="checkoutitems.php" method="POST">
					<div align="center">
						<div class="btn-group btn-large">
							<h3>Checkout Items (For Experiments)</h3>
						</div>
					</div>
					<div align="center">
						<table class="table">
							<tr>
								<td>
									<label class="form-control input-sm text-primary" align="center"><b>Experiment Name</b></label>
								<td>
									<input type="text" placeholder="e.g.-'Simple Pendulum'" id="expnm" name="expname" onkeyup="getDBStuff()" class="form-control input-sm">
									<input type="number" id="bookid" name="bookingid" value="<?php echo $_GET['bookingid']; ?>" hidden>
									<br>
									<div id="studentname" class="text-secondary">Start typing to see experiments.</div>
							<tr>
								<td>
									<label class="form-control input-sm text-primary" align="center"><b>No. of Students</b></label>
								<td>
									<input class="form-control" type="number" name="quantity" min="1" required>
							<tr>
								<td colspan="2">
									<button class="btn btn-success btn-block" type="submit">Checkout</button>
						</table>
					</div>
				</form>
			</div>
			<div class="col-sm-6 bg-white">
				<div align="center">
					<div class="btn-group btn-large">
						<h3>All Experiments</h3>
				</div>
				<table class="table table-hover">
				<thead class="thead thead-dark">
					<tr>
						<th>Experiment</th>
						<th>Items</th>
					</tr><br>
				</thead>
				<tbody>
					<?php
					function stringres($sql, $attr){
						include '../db.php';
						$res = $conn->query($sql);
						$ret = '  (';
						while ($row = $res->fetch_assoc()) {
							$ret .= $row[$attr] . ', ';
						}
						$ret = rtrim($ret, ', ') . ')';
						return $ret;
					}

					global $conn;

					$sql = 'select exp_name from experiment where 1;';

					$result = $conn->query($sql);

					if ($result->num_rows > 0) {
						while ($row = $result->fetch_assoc()) {
							$sql = 'SELECT a.exp_name, a.id, b.exp_id, i.id, i.item_name as item_name from experiment a, experiment_item b, item i where a.exp_name = "' . $row['exp_name'] . '" AND a.id=b.exp_id AND b.item_id = i.id;';
							$itemswithb = stringres($sql, 'item_name');
							$items = substr($itemswithb, 3, strlen($itemswithb)-4);
							?>

							<tr>
								<td><?php echo $row['exp_name'];?>
								<td><?php echo $items?>
							</tr>

					<?php
						}
					}

					$conn->close();
					?>
			</table>
		</div>
	</div>
	<script language="javascript" type="text/javascript">
		function setitemvalues(id, name) {
			document.getElementById('itemid').value = id;
			document.getElementById('inm').value = name;
		}

		function setexp(id, name) {
			document.getElementById('expnm').value = name;
		}

		function getDBStuff() {
			var ajaxRequest;

			try {
				ajaxRequest = new XMLHttpRequest();
			} catch (e) {
				try {
					ajaxRequest = new ActiveXObject("Msxml2.XMLHTTP");
				} catch (e) {
					try {
						ajaxRequest = new ActiveXObject("Microsoft.XMLHTTP");
					} catch (e) {
						alert("Oops! Something went wrong.");
						return false;
					}
				}
			}

			ajaxRequest.onreadystatechange = function() {
				if (ajaxRequest.readyState == 4) {
					var studentDisplay = document.getElementById('studentname');
					let res = ajaxRequest.responseText.split("###");
					studentDisplay.innerHTML = res[0];
				}
			}

			var rollno = document.getElementById('expnm').value;

			var queryString = "?expname=" + rollno;
			ajaxRequest.open("GET", "getname.php" + queryString, true);
			ajaxRequest.send(null);
		}
	</script>
</body>

</html>