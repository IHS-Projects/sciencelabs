<?php require_once '../db.php'; ?>
<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    global $conn;

    $name = $_REQUEST['name'];
    $email = $_REQUEST['email'];

    $sql = 'select * from teacher where teacher_name="' . $name . '";';
    $id = $conn->query($sql)->fetch_assoc()['id'];

    if ($email == $conn->query($sql)->fetch_assoc()['email']) {
        //Adding PHPMailer
        require '..\PHPMailer\third_party\phpmailer\PHPMailerAutoload.php';

        $mail = new PHPMailer(true);
		
        $mail->IsSMTP(); // telling the class to use SMTP
        $mail->SMTPAuth = true; // enable SMTP authentication
        $mail->SMTPSecure = "ssl"; // sets the prefix to the server
        $mail->Host = "smtp.gmail.com"; // sets GMAIL as the SMTP server
        $mail->Port = 465; // set the SMTP port for the GMAIL server
        $mail->Username = "abhinav@ishahomeschool.org"; // GMAIL username
        $mail->Password = "9738421573"; // GMAIL password

        //Senders information
        $email_from = "abhinav@ishahomeschool";
        $name_from = "Abhinav Srivatsa";

        //Typical mail data
        $mail->AddAddress($email, $name);
        $mail->SetFrom($email_from, $name_from);
        $mail->Subject = "Change Science Labs Password";
        $mail->Body = "To change your password click <html> <a href='10.0.3.119/sciencelabs/pass/changepass.php?id=".$id."'>here</a>.<br><br>
						If this link doesn't work follow this link: <br><br>
						10.0.3.119/sciencelabs/pass/changepass.php?id=".$id;
        $mail->IsHTML(true);

        try {
            $mail->Send();
            echo "<script>alert('Mail sent successfully!');document.location.href='../'</script>";
        } catch (Exception $e) {
			echo '<script>alert("'.$e.'");';
            echo "<script>alert('Something went wrong. Try again later.');document.location.href='../'</script>";
        }
    } else {
        echo '<script>alert("Username and Email Do Not Match");</script>';
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
    <script>
        function back() {
            document.location.href = "../";
        }
    </script>

    <div class="container-fluid">
        <br>
        <br>
        <div class="row">
            <div class="col-sm-4"></div>
            <div class="col-sm-4">
                <form action="<?php $_SERVER = ["PHP_SELF"] ?>" method="POST">
                    <table class="table">
                        <tr>
                            <div align="center">
                                <h3>Forgot Password</h3>
                            </div>
                        <tr>
                            <td>
                                <label class="form-control input-sm text-primary" align="center"><b>Username</b></label>
                            <td>
                                <input class="form-control input-sm" type="text" placeholder="Enter Username" name="name" autofocus required></input>
                        <tr>
                            <td>
                                <label class="form-control input-sm text-primary" align="center"><b>Email</b></label>
                            <td>
                                <input class="form-control input-sm" type="text" placeholder="Enter Email" name="email" autofocus required></input>
                        <tr>
                            <td colspan="2">
                                <button class="btn btn-warning btn-block" type="submit">Send Email</button>
                        <tr>
                            <td colspan="2">
                                <button class="btn btn-light btn-block" onclick="back()">Cancel</button>
                    </table>
                </form>
            </div>
            <div class="col-sm-4"></div>
        </div>
    </div>
</body>

</html>