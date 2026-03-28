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
            padding-top:15%;
        }
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
    <div class = "main-con">
        <div class = "heading">
            <div class = "header">
                <div class = "heading">
                    <center>
                        <table border="0">
                            <tbody>
                                <tr>
                                    <th><h1>Medicine - Master (Add)</h2></th>
                                    </tr>
                                </tbody>
                            </table>
                        </center>
                    </div>    
                    <div class="navbar2">
                        <a href="04.01.01.addmed.html">Add</a>
                        <a href="04.01.02.delmed.php">Delete</a>
                        <a href="04.01.03.modmed.php">Modify</a>
                    </div>   <br><br> 
                </div>
            </div>  
            <br>
    </div> 
</body>
</html>

<?php 
$servername = "localhost";
$username = "mym";
$password = "mym123";
$dbname = "mym";

$name = $_POST['name'];
$location = $_POST['location'];
$packaging = $_POST['packaging'];
$price = $_POST['price'];
$gencomp = $_POST['gencomp'];
$company = $_POST['company'];

$conn = new mysqli ($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
    
$medicine = "INSERT INTO medicine(m_name, m_location, m_packaging, m_mrp, m_composition, company_id)
values ('$name', '$location', '$packaging','$price', '$gencomp','$company')";

if ($conn->query(($medicine)) === TRUE) {
    echo "<center>Medicine Added Successfully!</center><br>";
}
else {
    echo "Error creating table: " . $conn->error;
}    
$conn->close();
?>

<div class = "main-con">
    <form action="04.01.01.addmed.html">
        <center><button style="width: 15vw;" type="submit" id="submit-button" class="submit-button">Add Medicine</button></center> 
    </form>       
</div>

<footer>
    <p>MYM Medical © 2024 - All rights reserved.</p>
</footer>