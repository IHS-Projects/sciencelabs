<html>

<head>
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <script src="../js/bootstrap.min.js"></script>
</head>

<?php
include '../navbar.php';
?>

<script>
    function getData() {
        let tbody = document.getElementById("tbody");
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
                tbody.innerHTML = request.responseText;
            }
        }

        request.open("GET", "getOrders.php", true);
        request.send(null);
    }

    function arrived(row) {
        let tr = document.getElementById("row" + row);

        tr = tr.firstChild;
        let student_id = tr.id;
        tr = tr.nextSibling;
        let item_id = tr.id;
        tr = tr.nextSibling;
        let quantity = tr.innerHTML;

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
                alert("Item returned");
                document.location.href="../checkout/reviewcheckout.php";
            }
        }

        let queryString = "?student=" + student_id + "&item=" + item_id + "&quantity=" + quantity;
        request.open("GET", "returnItem.php" + queryString, true);
        request.send(null);
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
                    <h3>Pending Student Returns</h3>
                </div>
                <div align="center">
                    <table class="table">
                        <thead class="thead thead-dark">
                            <th>Student
                            <th>Item
                            <th>Quantity
                            <th>Checkout Date
                            <th>Returned?
                        </thead>
                        <tbody id="tbody">
                            <script>
                                getData();
                            </script>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</body>

</html>