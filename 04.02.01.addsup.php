<!DOCTYPE html>
<html lang="en">
 
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MYM - Supplier Master</title>
    <link rel="stylesheet" href="00.main.css" />
    <style>
        footer {
            left: 0;
            bottom: 0;
            width: 100%;
            color: #fff;
            text-align: center;
            padding: 10px 0;
            padding-top:12%;
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
                                    <th><h1>Supplier - Master (Add)</h2></th>
                                    </tr>
                                </tbody>
                            </table>
                        </center>
                    </div>    
                    <div class="navbar2">
                        <a href="04.02.01.addsup.html">Add</a>
                        <a href="04.02.02.delsup.php">Delete</a>
                        <a href="04.02.03.modsup.php">Modify</a>
                    </div>    <br><br>
                </div>
            </div> <br> 
                
                
    </div>

</body>
</html>

<?php 
$servername = "localhost";
$username = "mym";
$password = "mym123";
$dbname = "mym";

$name = $_POST['name'];
$email = $_POST['mail'];
$address = $_POST['address'];
$contact_no = $_POST['contnum'];

$conn = new mysqli ($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$supplier = "INSERT INTO supplier(s_name, s_mail, s_address, s_phoneNo)
values ('$name', '$email', '$address', '$contact_no')";

if ($conn->query(($supplier)) === TRUE) {
    echo "<center>Supplier Added Successfully!</center><br>";
}
else {
    echo "Error creating table: " . $conn->error;
}    
$conn->close();
?>

<div class = "main-con">
    <form action="04.02.01.addsup.html">
        <center><button style="width: 15vw;" type="submit" id="submit-button" class="submit-button">Add Supplier</button></center>        
    </form>
</div>
<footer>
    <p>MYM Medical © 2024 - All rights reserved.</p>
</footer>


