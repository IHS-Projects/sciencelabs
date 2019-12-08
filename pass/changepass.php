<?php
require_once '../db.php';
$uid = $_GET["id"];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_REQUEST['name'];
    $pass = $_REQUEST['pass'];
    $conf = $_REQUEST['conf'];

    $sql = "select * from teacher where teacher_name='" . $name . "'";
    if ($uid == $conn->query($sql)->fetch_assoc()['id']) {
        if ($pass == $conf) {
            $sql = "update teacher set teacher_pass='" . $pass . "' where id=" . $uid . ";";
            $conn->query($sql);
            echo "<script>alert('Password updated successfully!');document.location.href='../';</script>";
        } else {
            echo "<script>alert('Passwords do not match!');</script>";
        }
    } else {
        echo "<script>alert('Username does not match!');</script>";
    }
}
?>

<html>

<head>
    <link rel="stylesheet" href="../css/bootstrap.min.css">
	<script src="../js/jquery-3.4.1.min.js"></script>
	<script src="../js/popper.min.js"></script>
	<script src="../js/bootstrap.min.js"></script>
</head>

<body>
    <div class="container-fluid">
        <br>
        <br>
        <div class="row">
            <div class="col-sm-4"></div>
            <div class="col-sm-4 bg-white" align="center">
                <div align="center">
                    <div class="btn-group btn-large">
                        <h3>Change Password</h3>
                    </div>
                    <div class="float-right"><img src="../img/Technology Elements/joystick.svg" height="50" width="50" align="center" border="0" alt="Icon"></div>
                </div>
                <div align="center">
                    <form action="<?php $_SERVER = ["PHP_SELF"] ?>" method="POST">
                        <table class="table">
                            <tr>
                                <td>
                                    <label class="form-control input-sm text-primary" align="center"><b>Username</b></label>
                                <td>
                                    <input class="form-control input-sm" type="text" placeholder="Enter Username" name="name" autofocus required></input>
                            <tr>
                                <td>
                                    <label class="form-control input-sm text-primary" align="center"><b>Password</b></label>
                                <td>
                                    <input class="form-control input-sm" type="password" placeholder="Enter Password" name="pass" required></input>
                            <tr>
                                <td>
                                    <label class="form-control input-sm text-primary" align="center"><b>Confirm</b></label>
                                <td>
                                    <input class="form-control input-sm" type="password" placeholder="Confirm Password" name="conf" required></input>
                            <tr>
                                <td colspan="2">
                                    <button class="btn btn-success btn-block" type="submit">Submit</button>

                    </form>
                </div>
                <div class="col-sm-4"></div>
            </div>
</body>

</html>