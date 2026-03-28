<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MYM - Company Master</title>
    <link rel="stylesheet" href="00.main.css" />
    <style>
       
        table {
            width: 100%;
            margin: 0;
            padding: 0;
        }
 
        td {
            padding: 10px;
            vertical-align: top;
            width: 50%;
        }
 
        .form-group label {
            margin-bottom: 5px;
            color: #F0F5F9;
            display: block;
        }
 
        .form-group input {
            padding: 15px;
            border: 1px solid #ccc;
            border-radius: 3px;
            margin-bottom: 10px;
            width: 100%;
            box-sizing: border-box;
            margin-left: auto;
            font-family: 'CP', sans-serif;
        }
    </style>
</head>

<body>
    <div class="logo">
        <a href="02.dashboard.html"><img src="logo.png" alt="MYM Medical"></a>
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
    <div class = "main-con">
        <div class = "heading">
            <div class = "header">
                <div class = "heading">
                    <center>
                        <table border="0">
                            <tbody>
                                <tr>
                                    <th><h1>Company - Master (Modify)</h2></th>
                                    </tr>
                                </tbody>
                            </table>
                        </center>
                    </div>    
                    <div class="navbar2">
                        <a href="04.03.01.addcomp.html">Add</a>
                        <a href="04.03.02.delcomp.php">Delete</a>
                        <a href="04.03.03.modcomp.php">Modify</a>
                    </div>    
                </div>
            </div><br><br>
<?php
// Check if form data is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Establish connection to the database
    $servername = "localhost";
    $username = "mym";
    $password = "mym123";
    $dbname = "mym";

    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Retrieve supplier_id from URL parameters
    if(isset($_GET['comp_id'])) {
        // Decode the JSON string to get the supplier_id
        $compID = json_decode($_GET['comp_id']);

        // Prepare data for update
        $name = $_POST['name'];
        $address = $_POST['address'];
        $phone = $_POST['contnum'];

        // Update query
        $sql = "UPDATE company SET c_name='$name', c_address='$address', c_phoneNo='$phone' WHERE company_id='$compID'";

        if ($conn->query($sql) === TRUE) {
            echo "<center>Record updated successfully!</center>";
        } else {
            echo "Error updating record: " . $conn->error;
        }
    } else {
        echo "Supplier ID not provided.";
    }

    // Close connection
    $conn->close();
} else {
    // Redirect back if accessed directly without form submission
    header("Location: testcomp1.php");
    exit;
}
?>
