<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MYM - Inventory</title>
    <link rel="stylesheet" href="00.main.css" />
    <style>
        .search-box {
            width: 100%;
            padding: 5px;
            box-sizing: border-box;
            font-size: 1rem;
            text-align: center;
            color: #788189;
            border: 1px solid #ddd;
        }
        footer {
            left: 0;
            bottom: 0;
            width: 100%;
            color: #fff;
            text-align: center;
            padding: 10px 0;
        }
        .search-box:hover::placeholder {
            color: black;
        }

        td {
            text-align: center;
            padding: 5px;
        }

        .content table {
            border-collapse: collapse;
        }
    </style>
</head>

<body>
    <div class="logo">
    <a href="02.dashboard.php"><img src="logo.png" alt="MYM Medical"></a>
    </div>
    <br>
    <div class="navbar">
    <a href="02.dashboard.php">Dashboard</a>
    <div class="dropdown">
        <button class="dropbtn">Database</button>
        <div class="dropdown-content">
            <a href="04.01.mmedicine.html">Medicine</a>
            <a href="04.02.msupplier.html">Supplier</a>
            <a href="04.03.mcompany.html">Company</a>
        </div>
    </div>
    <a href="05.inventory.php">Inventory</a>
    <a href="03.billing.php">Bill</a>
    <a href="07.order.php">Order</a>
    <a href="06.supplier.php">Supplier</a>
</div><br>
    <div class="main-con">
        <div class="heading">
            <center>
                <table>
                    <tbody>
                        <tr>
                            <th colspan="2"><h1>Inventory</h1></th>
                        </tr>
                    </tbody>
                </table>
            </center>
        </div>
        <div class="content">
            <form method="post" action="">
                <center><th><button type="submit" name="search_btn" hidden>Search</button></th></center><br>
                <table border="1">
                    <tr>
                        <th><input type="text" name="search_name" class="search-box" placeholder="Name"></th>
                        <th><input type="text" name="search_id" style="width: 2.5rem" class="search-box" placeholder="ID"></th>
                        <th><input type="text" name="search_price" class="search-box" placeholder="Price"></th>
                        <th><input type="text" name="search_quantity" class="search-box" placeholder="Quantity"></th>
                        <th></th>
                        <th><input type="text" name="search_packaging" class="search-box" placeholder="Packaging"></th>
                        <th><input type="text" name="search_location" class="search-box" placeholder="Location"></th>
                        <th><input type="text" name="search_company" class="search-box" placeholder="Company"></th>
                        <th><input type="text" name="search_composition" class="search-box" placeholder="Composition"></th>
                    </tr>
                    <tr>
                        <th style="color: #980328; height: 2.6rem;">Name</th>
                        <th style="color: #980328">ID</th>
                        <th style="color: #980328">Price</th>
                        <th style="color: #980328">Quantity</th>
                        <th style="color: #980328; width: 60%">Last Ordered</th>
                        <th style="color: #980328">Packaging</th>
                        <th style="color: #980328; width: 100%">Location</th>
                        <th style="color: #980328;">Company</th>
                        <th style="color: #980328">Generic Composition</th>
                    </tr>
                    <?php
                    $servername = "localhost";
                    $username = "mym";
                    $password = "mym123";
                    $dbname = "mym";
                    
                    $conn = new mysqli($servername, $username, $password, $dbname);
                    
                    if ($conn->connect_error) {
                        die("Connection failed: " . $conn->connect_error);
                    }

                if (isset($_POST['search_btn'])) {
                    
                    $sql = "SELECT DISTINCT
                                m.medicine_id, 
                                m.m_name, 
                                m.m_mrp, 
                                m.m_composition, 
                                m.m_packaging, 
                                c.c_name,
                                m.m_location,
                                (
                                    SELECT MAX(so.o_date) 
                                    FROM sup_order so 
                                    JOIN order_items oi ON so.order_id = oi.order_id
                                    WHERE oi.medicine_id = m.medicine_id
                                ) AS o_date,
                                i.quantity
                            FROM 
                                medicine m
                            JOIN 
                                company c ON m.company_id = c.company_id
                            LEFT JOIN 
                                order_items oi ON m.medicine_id = oi.medicine_id
                            LEFT JOIN 
                                inventory i ON m.medicine_id = i.medicine_id
                            WHERE 1";

                    if (!empty($_POST['search_name'])) {
                        $search_name = $conn->real_escape_string($_POST['search_name']);
                        $sql .= " AND m.m_name LIKE '%$search_name%'";
                    }
                    if (!empty($_POST['search_id'])) {
                        $search_id = $conn->real_escape_string($_POST['search_id']);
                        $sql .= " AND m.medicine_id LIKE '%$search_id%'";
                    }
                    if (!empty($_POST['search_price'])) {
                        $search_price = $conn->real_escape_string($_POST['search_price']);
                        $sql .= " AND m.m_mrp LIKE '%$search_price%'";
                    }
                    if (!empty($_POST['search_quantity'])) {
                        $search_quantity = $conn->real_escape_string($_POST['search_quantity']);
                        $sql .= " AND i.quantity LIKE '%$search_quantity%'";
                    }
                    if (!empty($_POST['search_packaging'])) {
                        $search_packaging = $conn->real_escape_string($_POST['search_packaging']);
                        $sql .= " AND m.m_packaging LIKE '%$search_packaging%'";
                    }
                    if (!empty($_POST['search_location'])) {
                        $search_location = $conn->real_escape_string($_POST['search_location']);
                        $sql .= " AND m.m_location LIKE '%$search_location%'";
                    }
                    if (!empty($_POST['search_company'])) {
                        $search_company = $conn->real_escape_string($_POST['search_company']);
                        $sql .= " AND c.c_name LIKE '%$search_company%'";
                    }
                    if (!empty($_POST['search_composition'])) {
                        $search_composition = $conn->real_escape_string($_POST['search_composition']);
                        $sql .= " AND m.m_composition LIKE '%$search_composition%'";
                    }
                    
                    
                    $result = $conn->query($sql);

                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            echo "<tr><td>" . $row['m_name'] . "</td><td>" . $row['medicine_id'] . "</td><td>" . $row['m_mrp'] . "</td><td>" . $row['quantity'] . "</td><td>" . $row['o_date'] . "</td><td>" . $row['m_packaging'] . "</td><td>". $row['m_location'] . "</td><td>" . $row['c_name'] . "</td><td>" . $row['m_composition'] . "</td></tr>";
                        }
                    } else {
                        echo "<tr><td colspan='8'>No results found</td></tr>";
                    }
                } else {
                    
                    $sql = "SELECT DISTINCT
                                m.medicine_id, 
                                m.m_name, 
                                m.m_mrp, 
                                m.m_composition, 
                                m.m_packaging, 
                                c.c_name,
                                m.m_location,
                                (
                                    SELECT MAX(so.o_date) 
                                    FROM sup_order so 
                                    JOIN order_items oi ON so.order_id = oi.order_id
                                    WHERE oi.medicine_id = m.medicine_id
                                ) AS o_date,
                                i.quantity
                            FROM 
                                medicine m
                            JOIN 
                                company c ON m.company_id = c.company_id
                            LEFT JOIN 
                                order_items oi ON m.medicine_id = oi.medicine_id
                            LEFT JOIN 
                                inventory i ON m.medicine_id = i.medicine_id";
 
        $result = $conn->query($sql);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo "<tr><td>" . $row['m_name'] . "</td><td>" . $row['medicine_id'] . "</td><td>" . $row['m_mrp'] . "</td><td>" . $row['quantity'] . "</td><td>" . $row['o_date'] . "</td><td>" . $row['m_packaging'] . "</td><td>". $row['m_location'] . "</td><td>" . $row['c_name'] . "</td><td>" . $row['m_composition'] . "</td></tr>";
    }
} else {
    echo "<tr><td colspan='8'>No data available</td></tr>";
}
                }
$conn->close();
?>
            </table>
        </form>
        </div>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function () {
            var headers = document.querySelectorAll("tr:nth-child(2) th");

            headers.forEach(function (header, index) {
                header.addEventListener("click", function () {
                    sortTable(index);
                });
            });

            function sortTable(columnIndex) {
                var table, rows, switching, i, x, y, shouldSwitch, switchCount = 0;
                table = document.querySelector(".content table");
                switching = true;
                
                var direction = "asc";

                while (switching) {
                    switching = false;
                    rows = table.rows;

                    for (i = 2; i < (rows.length - 1); i++) {
                        shouldSwitch = false;

                        x = rows[i].getElementsByTagName("td")[columnIndex];
                        y = rows[i + 1].getElementsByTagName("td")[columnIndex];

                        
                        var xValue = parseFloat(x.textContent.trim());
                        var yValue = parseFloat(y.textContent.trim());

                        
                        if (isNaN(xValue) || isNaN(yValue)) {
                            xValue = x.textContent.trim().toLowerCase();
                            yValue = y.textContent.trim().toLowerCase();
                        }

                        
                        if ((direction == "asc" && xValue > yValue) || (direction == "desc" && xValue < yValue)) {
                            shouldSwitch = true;
                            break;
                        }
                    }

                    if (shouldSwitch) {
                        rows[i].parentNode.insertBefore(rows[i + 1], rows[i]);
                        switching = true;
                        
                        switchCount++;
                    } else {
                        
                        if (switchCount == 0 && direction == "asc") {
                            direction = "desc";
                            switching = true;
                        }
                    }
                }
            }
                    });
    </script>
<footer>
    <p>MYM Medical © 2024 - All rights reserved.</p>
</footer>
</body>

</html>