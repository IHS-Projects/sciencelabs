<?php require_once '../db.php'; ?>
<?php
if (session_status() == PHP_SESSION_NONE) {
	session_start();
}
global $conn;

$uname = $_SESSION['user'];

$sql = 'select * from teacher where id = ' . $uname . ';';
$result = $conn->query($sql);
while ($row = $result->fetch_assoc()) {
	$uname = $row['teacher_name'];
}

$lev = $_SESSION['level'];
$level = "";
if ($lev == 0) {
	$level = 'Admin ';
} else if ($lev == 1) {
	$level = 'Lab Master ';
} else {
	$level = 'Teacher ';
}

$lab = $_SESSION['lab'];
if ($lab == 'b') {
	$lab = 'success';
} else if ($lab == 'c') {
	$lab = 'primary';
} else {
	$lab = 'danger';
}
?>

<script src="../js/popper.min.js"></script>
<link rel="stylesheet" href="../css/font-awesome.min.css">

<nav class="navbar sticky-top navbar-expand-md navbar-dark bg-<?php echo $lab;?>">

	<div class="navbar-collapse collapse w-100 order-1 order-md-0 dual-collapse2">
		<ul class="navbar-nav mr-auto">
			<li class="nav-item">
				<a class="nav-link" href="/sciencelabs/home">Home</a>
			<li class="nav-item">
				<a class="nav-link" href="/sciencelabs/stock">Stock</a>
			<li class="nav-item">
				<a class="nav-link" href="/sciencelabs/requests">Requests</a>
			<li class="nav-item">
				<a class="nav-link" href="/sciencelabs/checkout">Checkout</a>
			<?php
			if($_SESSION['level'] != 2)
				echo '<li class="nav-item">
						<a class="nav-link" href="/sciencelabs/transactions/">Transactions</a>';
			?>
			<li class="nav-item">
				<a class="nav-link" href="/sciencelabs/bookings/">Bookings</a>
			<?php
				if($_SESSION['level'] == 0)
				echo '<li class="nav-item">
						<a class="nav-link" href="../dataentry/">Data Entry</a>';
			?>
		</ul>
	</div>

	<div class="mx-auto order-0">
		<a class="navbar-brand mx-auto" href="/sciencelabs/home"><?php echo $_SESSION['labname'];?>Lab</a>
		<button class="navbar-toggler" type="button" data-toggle="collapse" data-target=".dual-collapse2">
			<span class="navbar-toggler-icon"></span>
		</button>
	</div>
    
	<div class="navbar-collapse collapse w-100 order-3 dual-collapse2">
		<ul class="navbar-nav ml-auto">
			<li class="nav-item dropdown ml-auto">
				<span class="navbar-text text-white">
					<?php echo $level . $uname; ?> 
				</span>
				<a class="nav-link dropdown-toggle navbar-text text-white" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="fa fa-gear fa-spin" style="font-size:20px"></i> </a>
				<div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownMenuLink">
					<a class="dropdown-item" href="../user/changepass.php">Change Password</a>
					<?php
						if ($_SESSION['level'] != 2) {
							echo '<a class="dropdown-item" href="../reviewrequest/">Review Orders</a>';
						}
					?>
					<div class="dropdown-divider"></div>
					<a class="dropdown-item" href="../">Logout</a>
				</div>
			</li>
		</ul>
	</div>
</nav>

<script>
	function setActive(pagename) {
		var buttons = document.getElementsByClassName('nav-link');
		Array.prototype.forEach.call(buttons, function foreach(item, index) {
			if (item.innerHTML === pagename) {
				item.classList.add('active');
				item.classList.add('bg-light');
				item.classList.add('text-<?php echo $lab;?>');
			}
		});
	}
</script>