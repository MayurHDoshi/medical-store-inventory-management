<?php
$servername = "localhost";
$username = "mym";
$password = "mym123";
$dbname = "mym";

// Define the threshold value
$threshold = 20;

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT 
            m.m_name,
            i.quantity
        FROM 
            medicine m
        LEFT JOIN 
            inventory i ON m.medicine_id = i.medicine_id
            WHERE i.quantity< $threshold";

$data = []; 
$labels = [];

if ($result = $conn->query($sql)) { 
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $labels[] = $row['m_name']; // Use medicine name as labels
            $data[] = $row['quantity']; // Quantity from inventory
            
            // Check if quantity is below the threshold
            if ($row['quantity'] < $threshold) {
                // echo "<script>alert('Low stock for: " . $row['m_name'] . "');</script>";
            }
        }
    }
} else {
    echo "Error: " . $conn->error;
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MYM - Dashboard</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link rel="stylesheet" href="00.main.css" />
    <style>
        .center-align {
            text-align: center;
            display: flex;
            justify-content: center;
            align-items: center;
            padding-left: 30%;
            padding-right: 30%;            
        }
        footer {
            /* position: fixed; */
            left: 0;
            bottom: 0;
            width: 100%;
            color: #fff;
            text-align: center;
            padding: 10px 0;
        }
        .tablez {
            border: 1px solid;
            border-radius: 10px;
        }
        .scroll{
            overflow-y: auto;
            max-height: 60vh;
            text-align: center;
            /* display: flex; */
            justify-content: center;
            align-items: center;      
        }
        .notification-center {
            position: fixed;
            left: 0;
            top: 0;
            width: 50%;
            height: 100%;
            background-color: #fff;
            border-right: 2px solid #ddd;
            overflow-y: auto;
            z-index: 2;
            display: none;
            padding: 20px;
        }
        .notification-center-content {
            margin-top: 20px;
        }
        .notification-bell {
            position: absolute;
            top: 20px;
            left: 20px;
            width: 50px;
            height: 50px;
            cursor: pointer;
            z-index: 1;
        }
        .btn{
            background-color: #980328;
            color: #f0f5f9;
            border: none;
            cursor: pointer;
            border-radius: 5px;
            width: 11vw;
            height: 7vh;
            font-size: 1.30rem;
            font-family: 'CP';
        }
    </style>
</head>
<body>
    <img src="bell.png" alt="Notification Bell" class="notification-bell" onclick="toggleNotificationCenter()">
    <div class="notification-center" id="notificationCenter">
        <button class="btn" onclick="closeNotificationCenter()">Close</button>
        <h3 style="border-bottom: 1px solid #ddd; padding-bottom: 10px;">Notification Center</h3>
        <div class="notification-center-content">
            <?php
            // PHP code to retrieve data for notification center
            $servername = "localhost";
            $username = "mym";
            $password = "mym123";
            $dbname = "mym";

            $conn = new mysqli($servername, $username, $password, $dbname);

            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }

            $sql = "SELECT m_name, quantity FROM medicine LEFT JOIN inventory ON medicine.medicine_id = inventory.medicine_id WHERE quantity < $threshold";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                echo "<h3>Medications with Quantity Below Threshold:</h3>";
                while ($row = $result->fetch_assoc()) {
                    echo "<p>" . $row['m_name'] . " - " . $row['quantity'] . "</p>";
                }
            } else {
                echo "<p>No medications with quantity below threshold found.</p>";
            }

            $conn->close();
            ?>
        </div>
    </div>

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
    </div><br><br>

    <div class="main-con">
        <div class="heading">
            <center>
                <table>
                    <tbody>
                        <tr>
                            <th colspan="2"><h1>Dashboard</h1></th>
                        </tr>
                    </tbody>
                </table> 
            </center>
        </div>
    </div>

    <div class="center-align">
        <table  border="0" style="width: 50rem; height: 5rem;">
        <tr>
            <td colspan="4">
                <h2 align="center">Quantity of Medicine under Threshold Quantity</h2>
            </td>
        </tr>
        <tr>
            <td>
                <div class="graph">
                    <canvas id="barchart" style="width: 65rem; height: 25rem;"></canvas>
                </div>
                <script>
    var labels = <?php echo json_encode($labels); ?>;
    var data = <?php echo json_encode($data); ?>;
    var ctx = document.getElementById('barchart').getContext('2d');
    var chart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: labels,
            datasets: [{
                label: ' Inventory Quantity',
                data: data,
                backgroundColor: 'rgba(152, 3, 40, 1)',
                borderColor: 'rgba(75, 192, 192, 1)',
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                yAxes: [{
                    ticks: {
                        beginAtZero: true
                    }
                }],
                xAxes: [{
            ticks: {
                callback: function(value, index, values) {
                    return 100000; // You can modify this function to return the label with desired font size
                }
            }
        }]
            }
        }
    });
</script>


            </td>
        </tr>
        </table>
    </div>
    <br>
    <div class="center-align">
        <a href="05.inventory.php"> 
            <table border="0" style="width: 100%">
                <tr>
                    <td colspan="4">
                        <h2 align='center'>Inventory</h2>
                    </td>
                </tr>
                <tr>
                    <td>
                        <div class="scroll">
                            <table border="1" style='border-radius:5px'>
                                <tr>
                                    <th style= "width: 15rem">Id</th>
                                    <th style= "width: 100%">Name</th>
                                    <th style= "width: 10rem">Price</th>
                                <?php
                                $servername = "localhost";
                                $username = "mym";
                                $password = "mym123";
                                $dbname = "mym";

                                $conn = new mysqli($servername, $username, $password, $dbname);

                                if ($conn->connect_error) {
                                    die("Connection failed: " . $conn->connect_error);
                                }

                                $sql2 = "SELECT DISTINCT
                                            medicine_id, 
                                            m_name, 
                                            m_mrp
                                    FROM 
                                        medicine";
                                    $result2 = $conn->query($sql2);

                                if ($result2->num_rows > 0) {
                                    while ($row = $result2->fetch_assoc()) {
                                        echo "<tr><td style = 'text-align: right;'>  " . $row['medicine_id'] . "</td><td>" . $row['m_name'] . "</td><td style = 'text-align: right;'> " . $row['m_mrp']  . "</td></tr>";
                                    }
                                }
                                ?>
                            </tr>
                            </table>
                        </div>
                    </td>
                </tr>
            </table>
        </a>
    </div>
    <div class="center-align" style="padding-top:2%;">
        <div class="scroll">
            <table border="0" style="width: 30rem;display:flex;">
                <tr><td colspan="4"> <h2 align='center'> Supplier </h2> </td></tr>
                <tr>
                    <td>
                        <?php
                            $sql3 = "SELECT s_name, s_phoneNo FROM supplier";
                                $result3 = $conn->query($sql3);
                                if ($result3->num_rows > 0) {
                                    
                                    while ($row = $result3->fetch_assoc()) {
                                        echo "
                                        <a href='06.supplier.php'>
                                        <table border='0' class='tablez' style='width: 27rem ; text-align: left;padding left:0%;'>
                                            <tr>
                                                <td style='text-align: center; height: 50px; width: var(--customWidth);'>Supplier Name</td>
                                                <td style='text-align: center; height: 50px; width: 2%;'>:</td>
                                                <td style='text-align: center; height: 50px; width: 30%;'>" . $row['s_name'] . "</td>
                                            </tr>
                                            <tr>
                                                <td style='text-align: center; height: 50px; width: var(--customWidth);'>Contact No.</td>
                                                <td style='text-align: center; height: 50px; width: 2%;'>:</td>
                                                <td style='text-align: center; height: 50px; width: 45%;'>" . $row['s_phoneNo'] . "</td>
                                            </tr>
                                            </a>
                                        </table>
                                        <br>";
                                    }
                                } else {
                                    echo "No results found";
                                }
                            $conn->close();
                        ?>
                    </td>
                </tr>
            </table>
        </div>
    </div>
    <br>
    <div class="center-align">
        <div class="scroll">
            <a href="07.order.php">
            <table border="0" style="width: 30rem">
                    <tr style="widh: 100%;"><td><h2 align='center'> Order </h2></td></tr>
                        <tr>
                            <td>
                                <?php
                                $servername = "localhost";
                                $username = "mym";
                                $password = "mym123";
                                $dbname = "mym";

                                $conn = new mysqli($servername, $username, $password, $dbname);

                                if ($conn->connect_error) {
                                    die("Connection failed: " . $conn->connect_error);
                                }
                                $sql4 = "SELECT order_id,delivery_date,supplier_id from sup_order";
                                $result4 = $conn->query($sql4);
                                
                                if($result4->num_rows > 0){
                                    while ($row = $result4->fetch_assoc()) {
                                        echo "
                                        <table border='0' class='tablez' style='width: 27rem; text-align: left;'>
                                            <tr>
                                                <td style='text-align: center; height: 50px; width: var(--customWidth);'>Order ID</td>
                                                <td style='text-align: center; height: 50px; width: 2%;'>:</td>
                                                <td style='height: 50px; text-align: center; width: 45%'>" . $row['order_id'] . "</td>
                                            </tr>
                                            <tr>
                                                <td style='text-align: center; height: 50px; width: var(--customWidth);'>Delivery Date</td>
                                                <td style='text-align: center; height: 50px; width: 2%;'>:</td>
                                                <td style='height: 50px; text-align: center; width: calc(100% - 2% -  var(--customWidth));'>" . $row['delivery_date'] . "</td>
                                            </tr>
                                            <tr>
                                                <td style='text-align: center; height: 50px; width: var(--customWidth);'>Supplier ID</td>
                                                <td style='text-align: center; height: 50px; width: 2%;'>:</td>
                                                <td style='height: 50px; text-align: center; width: calc(100% - 2% -  var(--customWidth));'>" . $row['supplier_id'] . "</td>
                                            </tr>
                                            <br>
                                        </table>";
                                } 
                                } else{
                                    echo "0 results";
                                }
                                $conn->close();
                                ?>
                            </a>
                        </td>
                    </tr>
                </table>
            </div>
        </div>
    <footer>
        <p>MYM Medical © 2024 - All rights reserved.</p>
    </footer>
    <script>
        function toggleNotificationCenter() {
            var notificationCenter = document.getElementById("notificationCenter");
            if (notificationCenter.style.display === "none") {
                notificationCenter.style.display = "block";
            } else {
                notificationCenter.style.display = "none";
            }
        }
        function closeNotificationCenter() {
            var notificationCenter = document.getElementById("notificationCenter");
            notificationCenter.style.display = "none";
        }
    </script>
</body>
</html>