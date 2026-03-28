<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MYM - Medicine Master</title>
    <link rel="stylesheet" href="00.main.css" />
    <style>
        footer {
            left: 0;
            bottom: 0;
            width: 100%;
            color: #fff;
            text-align: center;
            padding: 10px 0;
        }
        .search-box {
            width: 100%;
            padding: 5px;
            box-sizing: border-box;
            font-size: 1rem;
            text-align: center;
            color: #788189;
            border: none;
        }

        .search-box:hover {
            background-color: white;
        }

        .search-box:hover::placeholder {
            color: black;
        }

        td {
            text-align: center;
        }

        .content table {
            border-collapse: collapse;
        }

        input[type="checkbox"] {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            height: 2.5vh;
            width: 2.5vh;
        }
        .fixed-button:disabled {
            cursor: not-allowed;
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
            <div class="header">
                <div class="heading">
                    <center>
                        <table border="0">
                            <tbody>
                                <tr>
                                    <th>
                                        <h1>Medicine - Master (Delete)</h2>
                                    </th>
                                </tr>
                            </tbody>
                        </table>
                    </center>
                </div>
                <div class="navbar2">
                    <a href="04.01.01.addmed.html">Add</a>
                    <a href="04.01.02.delmed.php">Delete</a>
                    <a href="04.01.03.modmed.php">Modify</a>
                </div>
            </div>
            <br><br>
            <center><button class="fixed-button" disabled onclick="handleButtonClick()">Confirm</button></center>
        </div>
        <br>
        <div class="content">
            <form method="post">
            <center><th><button type="submit" name="search_btn" hidden>Search</button></th></center><br>
            <table border="1">
                <tr>
                <th><img src = "search.png" style = "height: 1rem; margin-top: 6px"></th>
                    <th><input type="text" name="search_name" class="search-box" list="names" placeholder="name"></th>
                    <th><input type="text" name="search_id" class="search-box" list="ids" placeholder="ID"></th>
                    <th><input type="text" name="search_price" class="search-box" placeholder="price"></th>
                    <th><input type="text" name="search_quantity" class="search-box" placeholder="quantity"></th>
                    <th></th>
                    <th><input type="text" name="search_packaging" class="search-box" list="packagings" placeholder="packaging"></th>
                    <th><input type="text" name="search_company" class="search-box" placeholder="company"></th>
                    <th><input type="text" name="search_composition" class="search-box" placeholder="generic composition"></th>
                </tr>
                <tr>
                    <th style="color: #980328; height: 2.5rem">Select</th>
                    <th style="color: #980328">Name</th>
                    <th style="color: #980328">ID</th>
                    <th style="color: #980328">Price</th>
                    <th style="color: #980328">Quantity</th>
                    <th style="color: #980328; width: 160px">Last Ordered</th>
                    <th style="color: #980328">Packaging</th>
                    <th style="color: #980328">Company</th>
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
                    
                $sql ="SELECT DISTINCT
                        m.medicine_id, 
                        m.m_name, 
                        m.m_mrp, 
                        m.m_composition, 
                        m.m_packaging, 
                        c.c_name,
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
                    Where 1 ";
                
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
                if (!empty($_POST['search_company'])) {
                    $search_company = $conn->real_escape_string($_POST['search_company']);
                    $sql .= " AND c.c_name LIKE '%$search_company%'";
                }
                if (!empty($_POST['search_composition'])) {
                    $search_composition = $conn->real_escape_string($_POST['search_composition']);
                    $sql .= " AND m.m_composition LIKE '%$search_composition%'";
                }
                
                
                $result = $conn->query($sql);

                if($result->num_rows > 0){  
                while ($row = $result->fetch_assoc()) {
                    echo "<tr><td><input type='checkbox' value='" . $row['medicine_id'] . "' onchange='handleCheckboxChange()'></td><td>" . $row['m_name'] . "</td><td>" .$row['medicine_id']. "</td><td>" . $row['m_mrp']. "</td><td>" . $row['quantity'] . "</td><td>" . $row['o_date'] . "</td><td>" . $row['m_packaging'] . "</td><td>" .$row['c_name']. "</td><td>" .$row['m_composition']. "</td></tr>" ;
                }
            } else {
                    echo "<tr><td colspan='8'>No results found</td></tr>";
                }
            } else {
                
                $sql ="SELECT DISTINCT
                        m.medicine_id, 
                        m.m_name, 
                        m.m_mrp, 
                        m.m_composition, 
                        m.m_packaging, 
                        c.c_name,
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
                    ";

$result = $conn->query($sql);

if($result->num_rows > 0){  
    while ($row = $result->fetch_assoc()) {
        echo "<tr><td><input type='checkbox' value='" . $row['medicine_id'] . "' onchange='handleCheckboxChange()'></td><td>" . $row['m_name'] . "</td><td>" .$row['medicine_id']. "</td><td>" . $row['m_mrp']. "</td><td>" . $row['quantity'] . "</td><td>" . $row['o_date'] . "</td><td>" . $row['m_packaging'] . "</td><td>" .$row['c_name']. "</td><td>" .$row['m_composition']. "</td></tr>" ;
    }
} else {
    echo "<tr><td colspan='9'>No results found</td></tr>";
}
}
?>
               
            </table>
            </form>
        </div>
    </div>

    <script>
    function handleButtonClick() {
        var checkedCheckboxes = document.querySelectorAll('input[type="checkbox"]:checked');
        if (checkedCheckboxes.length > 0) {
            // Ask for confirmation
            if (confirm("You are about to delete a master from the database!")) {
                // Ask for password
                var password = prompt("Please enter the password:");
                if (password === 'pass@123') {
                    // Password is correct
                    alert("Master Deleted!");
                    // Direct to href
                    var medIds = [];
                    checkedCheckboxes.forEach(function(checkbox) {
                        medIds.push(checkbox.value);
                    });
                    var url = "delete_medicine.php?med_ids=" + encodeURIComponent(JSON.stringify(medIds));
                    window.location.href = url;
                } else {
                    // Wrong password
                    var retry = confirm("Wrong password! Do you want to retry?");
                    if (!retry) {
                        // Reload the page
                        location.reload();
                    } else {
                        // Ask for password again
                        handleButtonClick();
                    }
                }
            }
        } else {
            alert("Please select at least one medicine.");
        }
    }

    function handleCheckboxChange() {
        var checkboxes = document.querySelectorAll('input[type="checkbox"]');
        var confirmButton = document.querySelector('.fixed-button');
        var isChecked = false;

        checkboxes.forEach(function(checkbox) {
            if (checkbox.checked) {
                isChecked = true;
            }
        });

        confirmButton.disabled = !isChecked;
    }

    document.addEventListener('DOMContentLoaded', function () {
        const checkboxes = document.querySelectorAll('input[type="checkbox"]');
        const button = document.querySelector('.fixed-button');

        checkboxes.forEach(checkbox => {
            checkbox.addEventListener('change', function () {
                button.disabled = false; // Enable button regardless of checkbox state
                button.classList.toggle('active', true); // Always make button active
            });
        });

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