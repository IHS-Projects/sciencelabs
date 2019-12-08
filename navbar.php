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
			<li class="nav-item dropdown">
				<a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
				<?php echo $level . $uname; ?>
				</a>
				<div class="dropdown-menu" aria-labelledby="navbarDropdown">
				<a class="dropdown-item" href="#">Action</a>
				<a class="dropdown-item" href="#">Another action</a>
				<div class="dropdown-divider"></div>
				<a class="dropdown-item" href="#">Something else here</a>
				</div>
			</li>
			<span class="navbar-text text-white">
				<?php echo $level . $uname; ?>
			</span>
			<?php
			if ($_SESSION['level'] != 2) {
				echo '<li class="nav-item">
						<a class="nav-link" href="../reviewrequest/">Review Orders</a>';
			}
			?>
			<?php
			if ($_SESSION['level'] != 2) {
				echo '<li class="nav-item">
						<a class="nav-link" href="../checkout/reviewcheckout.php">Review Checkouts</a>';
			}
			?>

			<li class="nav-item">
				<a class="nav-link" href="../user/changepass.php">Change Password</a>
			<li class="nav-item dropdown">
				<a class="nav-link" href="../">Logout</a>
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