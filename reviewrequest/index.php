<?php include '../navbar.php'; ?>

<html>

<head>
    <link rel="stylesheet" href="../css/bootstrap.min.css">
	<script src="../js/jquery-3.4.1.min.js"></script>
	<script src="../js/popper.min.js"></script>
	<script src="../js/bootstrap.min.js"></script>
</head>

<script>
    function checkAll() {
        let input = document.getElementsByClassName("chk");
        let btn = document.getElementById("btn");
        if (btn.innerHTML == "Check All")
            btn.innerHTML = "Uncheck All";
        else
            btn.innerHTML = "Check All";

        let flag = false;
        let x = 0;

        while (x < input.length)
            if (!input[x++].checked) {
                flag = false;
                break;
            } else
                flag = true;
        x = 0;
        if (flag)
            while (x < input.length)
                input[x++].checked = false;
        else
            while (x < input.length)
                input[x++].checked = true;
    }

    function submit() {
        let item = document.getElementsByClassName("item");
        let quantity = document.getElementsByClassName("quan");
        let specs = document.getElementsByClassName("specs");
        let check = document.getElementsByClassName("chk");
        let comments = document.getElementsByClassName("comments");
        let bill = document.getElementById("bill");
        let x = 0;

        while (x < item.length) {
            if (check[x].checked && bill.value != "") {
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

                request.onreadystatechange = function() {
                    if (request.readyState == 4) {
                        document.location.href = "../reviewrequest/";
                    }
                }

                let queryString = "?item=" + item[x].innerHTML + "&quantity=" + quantity[x].innerHTML + "&specs=" + specs[x].innerHTML + "&comments=" + comments[x].value + "&bill=" + bill.value;
                request.open("GET", "review.php" + queryString, true);
                request.send(null);
            }
            x++;
        }
    }
</script>

<body>
    <div class="container-fluid">
        <br>
        <br>
        <div class="row">
            <div class="col-sm-3"></div>
            <div class="col-sm-6">
                <div align="center">
                    <div class="btn-group btn-group-lg">
                        <h2>Review Arrived Order</h2>
                    </div>
                </div>
                <table class="table">
                    <thead class="thead thead-dark">
                        <th>Name
                        <th>Quantity
                        <th>Specifications
                        <th>Arrived?
                        <th>Comments
                    </thead>
                    <tbody>
                        <?php
                        include_once '../db.php';

                        if (session_status() == PHP_SESSION_NONE) {
                            session_start();
                        }

                        $sql = "select * from purchase_request where lab='".$_SESSION['lab']."' and arrived=0;";
                        $result = $conn->query($sql);

                        $var = 0;
                        if ($result->num_rows > 0) {
                            while ($row = $result->fetch_assoc()) {
                                echo '<tr><td class="item">' . $row['item_name'] .
                                    '<td class="quan">' . $row['quantity'] .
                                    '<td class="specs">' . $row['specs'] .
                                    '<td><label class="container">
                                                <input id="chk' . $var . '" name="chk' . $var . '" type="checkbox" class="chk">
                                                <span class="checkmark"></span>
                                            </label>
                                    <td><input class="comments form-control input-sm"/>';
                                $var++;
                            }
                        }
                        ?>
                        <tr>
                            <td>
                            <td colspan="2"><button class="btn btn-warning float-right" onclick="checkAll()" id="btn">Check All</button>
                            <td><button class="btn btn-success" onclick="submit()">Submit</button>
                            <td><input id="bill" class="form-control input-sm" placeholder="Enter Bill Code" />
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>

</html>