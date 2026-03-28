<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Selected Records</title>
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
            padding-top: 18.5%;
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
            width: 100%
        }

        input[type="checkbox"] {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            height: 2.5vh;
            width: 2.5vh;
        }

        input[type="number"] {
            width: 10vw;
        }
    </style>
</head>

<body>
    <div class="main-con">
        <div class="heading">
            <center>
                <table>
                    <tbody>
                        <tr>
                            <th colspan="2">
                                <h1>Selected Records</h1>
                            </th>
                        </tr>
                    </tbody>
                </table>
            </center>
        </div>
        <div class="content">
            <table border="1">
                <tr>
                    <th style="color: #980328; height: 2.5rem">Name</th>
                    <th style="color: #980328">ID</th>
                    <th style="color: #980328">Price</th>
                    <th style="color: #980328">Quantity</th>
                    <th style="color: #980328">Packaging</th>
                    <th style="color: #980328">Company</th>
                    <th style="color: #980328">Generic Composition</th>
                    <th style="color: #980328">Remove</th>
                </tr>
                <?php
                if (isset($_GET['ids']) && isset($_GET['quantities'])) {
                    $selectedIds = $_GET['ids'];
                    $selectedQuantities = $_GET['quantities'];

                    $servername = "localhost";
                    $username = "mym";
                    $password = "mym123";
                    $dbname = "mym";

                    $conn = new mysqli($servername, $username, $password, $dbname);

                    if ($conn->connect_error) {
                        die("Connection failed: " . $conn->connect_error);
                    }

                    $sql = "SELECT m.medicine_id, m.m_name, m.m_mrp, m.m_composition, m.m_packaging, c.c_name, i.quantity
                            FROM medicine m
                            JOIN company c ON m.company_id = c.company_id
                            LEFT JOIN inventory i ON m.medicine_id = i.medicine_id
                            WHERE m.medicine_id IN (" . implode(',', $selectedIds) . ")";

                    $result = $conn->query($sql);

                    if ($result->num_rows > 0) {
                        foreach ($selectedIds as $key => $id) {
                            $row = $result->fetch_assoc();
                            echo "<tr>";
                            echo "<td>" . $row['m_name'] . "</td>";
                            echo "<td>" . $row['medicine_id'] . "</td>";
                            echo "<td>" . $row['m_mrp'] . "</td>";
                            echo "<td>" . (isset($selectedQuantities[$key]) ? $selectedQuantities[$key] : '') . "</td>"; // Display the entered quantity
                            echo "<td>" . $row['m_packaging'] . "</td>";
                            echo "<td>" . $row['c_name'] . "</td>";
                            echo "<td>" . $row['m_composition'] . "</td>";
                            echo "<td><button class='remove-btn' onclick='removeRow(this.parentNode.parentNode)'>Remove</button></td>";
                            echo "</tr>";
                        }
                    } else {
                        echo "<tr><td colspan='9'>No records found</td></tr>";
                    }

                    // Pass selected records' data to the generate bill page
                    $data = array();
                    foreach ($selectedIds as $key => $id) {
                        // Fetch the corresponding record from the result set
                        $result->data_seek($key);
                        $row = $result->fetch_assoc();

                        $data[] = array(
                            'id' => $row['medicine_id'],
                            'name' => $row['m_name'],
                            'price' => $row['m_mrp'],
                            'quantity' => isset($selectedQuantities[$key]) ? $selectedQuantities[$key] : ''
                        );
                    }
                    $encodedData = json_encode($data);
                    echo "<input type='hidden' id='selectedData' value='" . htmlentities($encodedData) . "'>";
                    $conn->close();
                } else {
                    echo 'No records selected.';
                }
                ?>
            </table><br>
            <center>
                <button style="width: 12%; font-size: 1.30rem;" type="button"  onclick="generateBill()">Generate</button>
                <a href="03.billing.php"><button type="button">Back</button></a>
            </center>
        </div>
    </div>
    <script>
        function removeRow(row) {
        row.parentNode.removeChild(row);
        }
        function generateBill() {
            var selectedData = document.getElementById('selectedData').value;
            var xhr = new XMLHttpRequest();
            xhr.open("POST", "03.01.update.inventory.php", true);
            xhr.setRequestHeader("Content-Type", "application/json;charset=UTF-8");
            xhr.onreadystatechange = function () {
                if (xhr.readyState === 4 && xhr.status === 200) {
                    // After updating inventory, redirect to the generate bill page
                    window.location.href = '03.02.generate.bill.php?data=' + encodeURIComponent(selectedData);
                }
            };
            xhr.send(selectedData);
        }
    </script>
<footer>
    <p>MYM Medical © 2024 - All rights reserved.</p>
</footer>
</body>

</html>
