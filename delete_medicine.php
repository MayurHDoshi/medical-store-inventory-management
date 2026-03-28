<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MYM - Medicine Master</title>
    <link rel="stylesheet" href="00.main.css" />
    <style>
        .search-box {
            width: 100%;
            padding: 5px;
            box-sizing: border-box;
            font-size: 1rem;
            text-align: center;
            color: #788189;
            border: none;
        }
        footer {
            /* position: fixed; */
            left: 0;
            bottom: 0;
            width: 100%;
            color: #fff;
            text-align: center;
            padding: 10px 0;
            padding-top: 20%;
        }
        .search-box:hover {
            background-color: rgb(0, 0, 0);
            color: white;
        }

        .search-box:hover::placeholder {
            color: white;
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
<?php
if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['med_ids'])) {
    $servername = "localhost";
    $username = "mym";
    $password = "mym123";
    $dbname = "mym";

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $error = false;

    // Retrieve med_ids from URL parameter
    $med_ids = json_decode($_GET['med_ids']);

    $sql = "DELETE FROM medicine WHERE medicine_id IN (";

    // Dynamically construct the parameter placeholders
    $placeholders = implode(',', array_fill(0, count($med_ids), '?'));

    $sql .= $placeholders . ")";
    
    $stmt = $conn->prepare($sql);

    // Bind the parameters
    $types = str_repeat('i', count($med_ids)); // Assuming all IDs are integers
    $stmt->bind_param($types, ...$med_ids);

    if (!$stmt->execute()) {
        $error = true;
    }

    $stmt->close();

    $conn->close();

    if ($error) {
        echo "<center>Error deleting medicine. Please try again later.</center>";
    } else {
        echo "<center>Medicine(s) deleted successfully!</center>";
    }
} else {
    echo "Invalid request";
}
?>
<center>
    <br>
<footer>
    <p>MYM Medical © 2024 - All rights reserved.</p>
</footer>
</center>