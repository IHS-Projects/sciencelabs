<html>

<head>
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <script src="../js/jquery-3.4.1.min.js"></script>
    <script src="../js/popper.min.js"></script>
    <script src="../js/bootstrap.min.js"></script>
</head>

<?php include '../navbar.php'; ?>
<script>
    setActive('Lab Transfers');
</script>

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

        request.open("GET", "getborrowedlist.php", true);
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
                document.location.reload();
            }
        }

        let queryString = "?checkout_id=" + row;
        request.open("GET", "returnborrow.php" + queryString, true);
        request.send(null);
    }

    function lost(row) {

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
                alert("Item recorded as lost.");
                document.location.reload();
            }
        }

        let queryString = "?checkout_id=" + row;
        request.open("GET", "lostborrow.php" + queryString, true);
        request.send(null);
    }
</script>

<body>
    <div class="container-fluid">
        <br>
        <div class="text-center">
            <button class="btn btn-primary" onclick="document.location.href='../labborrow/';">Borrow More</button>
        </div>
        <br>
        <div class="row">
            <div class="col-sm-3"></div>
            <div class="col-sm-6">
                <div align="center">
                    <h3>Items Lent Out</h3>
                </div>
                <div align="center">
                    <table class="table">
                        <thead class="thead thead-dark">
                            <th>Item
                            <th>Quantity
                            <th>Checkout Date
                            <th>Borrowed By
                            <th colspan="2">Status
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