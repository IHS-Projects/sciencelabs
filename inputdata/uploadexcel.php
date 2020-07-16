<?php
require_once '../db.php';
require_once '../checkSession.php';
?>
<html>

<head>
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <script src="../js/jquery-3.4.1.min.js"></script>
    <script src="../js/popper.min.js"></script>
    <script src="../js/bootstrap.min.js"></script>
    <?php include '../navbar.php' ?>
    <script>
        setActive("Home");
    </script>
</head>

<body>
    <div class="container-fluid">
        <br>
        <br>
        <div class="row">
            <div class="col-sm-12">
                <div align="center">
                    <h3>Upload CSV</h3>
                </div>
                <br>
                <div align="center">
                    <form action="implement.php" method="post" enctype="multipart/form-data">
                        Select Excel Sheet to upload:
                        <input type="file" name="uploadfile" id="uploadfile" accept=".xls, .xlsx">
                        <input class="btn btn-warning" type="submit" value="Upload Sheet" name="submit">
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>

</html>