<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="00.main.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MYM - Supplier</title>
    <style>
        tr, td {
            --customWidth: 17%;
        }
        .content table{
            border: 1px solid;
            border-radius: 10px;
            margin: 0.8%;
        }
        footer {
            left: 0;
            bottom: 0;
            width: 100%;
            color: #fff;
            text-align: center;
            padding: 10px 0;
        }
        .inputz{
            color: #788189;
            background-color: white;
            width: 25vw; 
            height: 4vh;
            border-radius: 3px;
            font-family: 'CP';
            border-style: solid;
            padding: 9px;
        }
        .form-type{
            background-color: #000000;
            padding: 0px;
            margin-bottom: 0px;
            margin-top: 0px;
            margin-left: 0px;
            margin-right: 0px;
            color: #F0F5F9;
            border: none;
            border-radius: 3px;
            cursor: pointer;
            display: inline-block;
            cursor: pointer;
            width: 100px; 
            height: 30px; 
            font-size: medium;
            font-family: 'CP';
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
            <center>
                <table border="0">
                    <tbody> 
                        <tr>
                            <th colspan="2"><h1>Supplier Information</h2></th>
                        </tr>
                        <tr align="center">
                            <td>
                                <form style="height: 50px; vertical-align: middle;" method="POST" action="">
                                    <input class="inputz" type="text" id="search" name="search">
                                    <button class="form-type" type="submit">Search</button>
                                </form>
                            </td>
                        </tr>
                    </tbody>
                </table>
                <br>
            </center>
        </div>
        <div class = "content">
            <?php
            $servername = "localhost";
            $username = "mym";
            $password = "mym123";
            $dbname = "mym";

            $conn = new mysqli($servername, $username, $password, $dbname);

            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }

            
            $search = "";

            if (isset($_POST['search']) && !empty($_POST['search'])) {
                $search = $conn->real_escape_string($_POST['search']);
                
                $sql = "SELECT supplier_id, s_name, s_mail, s_address, s_phoneNo FROM supplier 
                        WHERE supplier_id LIKE '%$search%' OR s_name LIKE '%$search%' OR s_mail LIKE '%$search%' OR s_address LIKE '%$search%' OR s_phoneNo LIKE '%$search%'";
            } else {
                $sql = "SELECT supplier_id, s_name, s_mail, s_address, s_phoneNo FROM supplier";
            }

            
            $result = $conn->query($sql);

            
            if ($result->num_rows > 0) {
                
                while ($row = $result->fetch_assoc()) {
                    echo "
                    <table border='0'>
                        <tr>
                            <td style='text-align: right; height: 50px; width: var(--customWidth);'>Supplier ID</td>
                            <td style='text-align: center; height: 50px; width: 2%;'>:</td>
                            <td style='height: 50px; width: calc(100% - 2% - var(--customWidth));'>" . $row['supplier_id'] . "</td>
                        </tr>
                        <tr>
                            <td style='text-align: right; height: 50px; width: var(--customWidth);'>Supplier Name</td>
                            <td style='text-align: center; height: 50px; width: 2%;'>:</td>
                            <td style='height: 50px; width: calc(100% - 2% - var(--customWidth));'>" . $row['s_name'] . "</td>
                        </tr>
                        <tr>
                            <td style='text-align: right; height: 50px; width: var(--customWidth);'>Supplier Email</td>
                            <td style='text-align: center; height: 50px; width: 2%;'>:</td>
                            <td style='height: 50px; width: calc(100% - 2% - var(--customWidth));'>" . $row['s_mail'] . "</td>
                        </tr>
                        <tr>
                            <td style='text-align: right; height: 50px; width: var(--customWidth);'>Supplier Address</td>
                            <td style='text-align: center; height: 50px; width: 2%;'>:</td>
                            <td style='height: 50px; width: calc(100% - 2% - var(--customWidth));'>" . $row['s_address'] . "</td>
                        </tr>
                        <tr>
                            <td style='text-align: right; height: 50px; width: var(--customWidth);'>Contact No.</td>
                            <td style='text-align: center; height: 50px; width: 2%;'>:</td>
                            <td style='height: 50px; width: calc(100% - 2% - var(--customWidth));'>" . $row['s_phoneNo'] . "</td>
                        </tr>
                    </table>
                    <br>";
                }
            } else {
                echo "No results found";
            }

            
            $conn->close();
            ?>
            <br> 
        </div>    
    </div>
    <footer>
    <p>MYM Medical © 2024 - All rights reserved.</p>
</footer>          
</body>
</html>
