<html>

<head>
	<link rel="stylesheet" href="../css/bootstrap.min.css">
	<script src="../js/jquery-3.4.1.min.js"></script>
	<script src="../js/popper.min.js"></script>
	<script src="../js/bootstrap.min.js"></script>
	<style>
		/* Style the tab */
		.tab {
			overflow: hidden;
			border: 1px solid #ccc;
			background-color: #f1f1f1;
		}

		/* Style the buttons inside the tab */
		.tab button {
			background-color: inherit;
			float: left;
			border: none;
			outline: none;
			cursor: pointer;
			padding: 14px 16px;
			transition: 0.3s;
			font-size: 17px;
		}

		/* Change background color of buttons on hover */
		.tab button:hover {
			background-color: #ddd;
		}

		/* Create an active/current tablink class */
		.tab button.active {
			background-color: #ccc;
		}

		/* Style the tab content */
		.tabcontent {
			display: none;
			padding: 6px 12px;
			border: 1px solid #ccc;
			border-top: none;
		}

		.pre-scrollable {
			max-height: 700px;
			overflow-y: scroll;
		}
	</style>
</head>

<script>
	function generateSQL(row) {
		let btn = document.getElementsByClassName("active");
		let tr = document.getElementById("row" + row);
		let table = btn[1].innerText;

		let request;

		try {
			request = new XMLHttpRequest();
		} catch (e) {
			try {
				request = new ActiveXObject("Msxml2.XMLHTTP");
			} catch (e) {
				try {
					request = new ActiveXObject("Microsoft.XMLHTTP");
				} catch (e) {
					return false;
				}
			}
		}

		request.onreadystatechange = function () {
			if (request.readyState == 4) {
				let text = document.getElementById("textarea");
				text.value = request.responseText;
			}
		}

		let queryString = "?table=" + table +"&row=" + row;
		request.open("GET", "getsql.php" + queryString, true);
		request.send(null);
	}
</script>

<body>
	<?php include '../navbar.php'; ?>
	<script>
		setActive('Data Entry');
	</script>

	<div class="container-fluid">
		<div class="row">
			<div class="col-sm-12">
				<div class="tab">
					<?php
						require_once '../db.php'; 
						$sql_gettables = 'show tables from labs;';
						$tablenames = $conn->query($sql_gettables);
						while($name = $tablenames->fetch_assoc()){
							echo '<button class="tablinks" onclick="openCity(event, \''.$name["Tables_in_labs"].'\')">'.$name["Tables_in_labs"].'</button>';
						}
					?>
				</div>

				<?php
				$tablenames = $conn->query($sql_gettables);
				while($tablename = $tablenames->fetch_assoc()){
					$sql_getfields = 'SELECT COLUMN_NAME FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_SCHEMA = \'labs\' AND TABLE_NAME = \''.$tablename["Tables_in_labs"].'\';';
					$fields = $conn->query($sql_getfields);
					echo '<div id="'.$tablename["Tables_in_labs"].'" class="tabcontent pre-scrollable"><table class="table table-striped table-bordered"><thead id="thead"><tr>';
					while($field = $fields->fetch_assoc()){
						echo '<th>'.$field["COLUMN_NAME"].'</th>';
					}
				
					echo '</tr></thead><tbody>';
					$sql_getall = 'select * from '.$tablename["Tables_in_labs"].';';
					$tabledata = $conn->query($sql_getall);
					$var = 0;
					while($row = $tabledata->fetch_assoc()){
						echo '<tr id="row' . $var . '" onclick="generateSQL(' . $var . ')">';
						$fields = $conn->query($sql_getfields);
						while($field = $fields->fetch_assoc()){
							echo '<td>'.$row[$field["COLUMN_NAME"]].'</td>';
						}
						echo '</tr>';
						$var++;
					}
					echo '</tbody></table></div>';
				}
				?>
			</div>
		</div>
		<hr>
		<div class="row">
			<form id="sqlForm" action="runsql.php" method="POST"></form>
			<div class="col-sm-9">
				<td><textarea class="form-control" name="sqlcode" form="sqlForm" id="textarea"></textarea>
			</div>

			<div class="col-sm-3">
				<button type="submit" class="btn btn-success btn-block form-control" form="sqlForm">Run</button>
			</div>
		</div>
	</div>

	<script>
		function openCity(evt, cityName) {
			var i, tabcontent, tablinks;
			tabcontent = document.getElementsByClassName("tabcontent");
			for (i = 0; i < tabcontent.length; i++) {
				tabcontent[i].style.display = "none";
			}
			tablinks = document.getElementsByClassName("tablinks");
			for (i = 0; i < tablinks.length; i++) {
				tablinks[i].className = tablinks[i].className.replace(" active", "");
			}
			document.getElementById(cityName).style.display = "block";
			evt.currentTarget.className += " active";
		}
	</script>
</body>

</html>