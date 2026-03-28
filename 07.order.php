<!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>MYM - Order</title>
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
            tr, td {
                --customWidth: 17%;
            }    
            .content table{
                border: 1px solid;
                border-radius: 10px;
            }
            .inputz{
                color: #788189
                background-color: white;
                width: 25vw;
                height: 4vh;
                border-radius: 3px;
                font-family: 'CP';
                border-style: solid;
                padding: 9px;
            }
            .form-popup {
                display: none;
                position: absolute;
                top: 0;
                left: 0;
                bottom: 0;
                width: 100%;
                height: 100%;
                background-color: rgba(0, 0, 0, 0.5);
                z-index: 9999;
                overflow-y: scroll;
                
            }
            .form-container {
                position: relative;
                top: 60%;
                left: 50%;
                transform: translate(-50%, -50%);
                padding: 10px;
                background-color: 1E2022;
                border: 3px solid #f1f1f1;
                border-radius: 5px;
                max-height: 80%;
                overflow-y: auto;
                width: 80%;
            }
            .form-type{
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
            .file-input {
            display: none;
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
                                <th><h1>Order Information</h2></th>
                            </tr>
                            <tr>
                                <td  align="center">
                                <button style="width: 15vw; cursor: pointer; background-color: #980328; border: none;" onclick="openForm('uploadForm')" type="button">Upload Order</button>
                                </td>
                            </tr>
                            <td style="height: 13vh;">
                                <form action="07.order.php" method="post" style="height: 50px; vertical-align: middle;">
                                    <input  class="inputz"type="text" id="search" name="search">
                                    <button  class="form-type"  type="submit">Search</button>
                                </form>
                            </td>
                        </tbody>
                    </table>
                    <?php
$servername = "localhost";
$username = "mym";
$password = "mym123";
$dbname = "mym";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_FILES['file']) && $_FILES['file']['error'] === UPLOAD_ERR_OK) {
        // Set session variable to indicate CSV upload

        $csvFile = $_FILES['file']['tmp_name'];

        $handle = fopen($csvFile, "r");
        fgetcsv($handle); // Skip the header row

        while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
            $order_quantity = $data[0];
            $medicine_id = $data[1];
            $order_id = $data[2];
            $order_date = $data[3];
            $delivery_date = $data[4];
            $status = $data[5];
            $supplier = $data[6];
            $formattedOrderDate = date('Y-m-d', strtotime($order_date));
            $formattedDeliveryDate = date('Y-m-d', strtotime($delivery_date));

            $sql = "INSERT INTO sup_order (order_id, o_date, delivery_date , order_status , supplier_id)
            VALUES ('$order_id','$formattedOrderDate','$formattedDeliveryDate','$status','$supplier')";

            $sql1 = "INSERT INTO order_items (quantity, medicine_id, order_id)
            VALUES ('$order_quantity','$medicine_id','$order_id')";

            if ($conn->query($sql) === TRUE) {
                echo "";
            } else {
                echo "" . $conn->error;
            }

            if ($conn->query($sql1) === TRUE) {
                echo "";
            } else {
                echo "" . $conn->error;
            }
        } 
        echo "<br><center>Record(s) updated successfully!</center>";
        fclose($handle);
        $sql1 = "UPDATE inventory AS i JOIN (SELECT oi.medicine_id, SUM(oi.quantity) AS total_quantity FROM order_items oi GROUP BY oi.medicine_id) AS order_quantities ON i.medicine_id = order_quantities.medicine_id SET i.quantity = i.quantity + order_quantities.total_quantity";
        if ($conn->query(($sql1)) === TRUE) {
        echo "";
        }  

     
    } else {
        echo "";
    }
}

$conn->close();
?>
            </center>
            <br>
            </div>
            <div class="content">  
            
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

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['search']) && !empty($_POST['search'])) {
    $search = $conn->real_escape_string($_POST['search']);
    $sql = "SELECT so.order_id, so.o_date, so.delivery_date, so.order_status, so.supplier_id, m.m_name
    FROM sup_order AS so
    INNER JOIN order_items AS oi ON so.order_id = oi.order_id
    INNER JOIN medicine AS m ON oi.medicine_id = m.medicine_id
    WHERE so.order_id LIKE '%$search%' OR so.o_date LIKE '%$search%' OR so.delivery_date LIKE '%$search%' OR so.order_status LIKE '%$search%' OR so.supplier_id LIKE '%$search%' OR m.m_name LIKE '%$search%'";
    $result1 = $conn->query($sql);
} else {
    $sql1 = "SELECT so.order_id, so.o_date, so.delivery_date, so.order_status, so.supplier_id, m.m_name
    FROM sup_order AS so
    INNER JOIN order_items AS oi ON so.order_id = oi.order_id
    INNER JOIN medicine AS m ON oi.medicine_id = m.medicine_id";
    $result1 = $conn->query($sql1);
}

if($result1->num_rows > 0){
    while ($row = $result1->fetch_assoc()) {
        echo "
        <table style='width: 100%;' border='0'>
            <tr>
                <td style='text-align: right; height: 50px; width: var(--customWidth);'>Order ID</td>
                <td style='text-align: center; height: 50px; width: 2%;'>:</td>
                <td style='height: 50px; text-align: left; width: calc(100% - 2% -  var(--customWidth));'>" . $row['order_id'] . "</td>
            </tr>
            <tr>
                <td style='text-align: right; height: 50px; width: var(--customWidth);'>Order Date</td>
                <td style='text-align: center; height: 50px; width: 2%;'>:</td>
                <td style='height: 50px; text-align: left; width: calc(100% - 2% -  var(--customWidth));'>" . $row['o_date'] . "</td>
            </tr>
            <tr>
                <td style='text-align: right; height: 50px; width: var(--customWidth);'>Delivery Date</td>
                <td style='text-align: center; height: 50px; width: 2%;'>:</td>
                <td style='height: 50px; text-align: left; width: calc(100% - 2% -  var(--customWidth));'>" . $row['delivery_date'] . "</td>
            </tr>
            <tr>
                <td style='text-align: right; height: 50px; width: var(--customWidth);'>Status</td>
                <td style='text-align: center; height: 50px; width: 2%;'>:</td>
                <td style='height: 50px; text-align: left; width: calc(100% - 2% -  var(--customWidth));'>" . $row['order_status'] . "</td>
            </tr>
            <tr>
                <td style='text-align: right; height: 50px; width: var(--customWidth);'>Supplier ID</td>
                <td style='text-align: center; height: 50px; width: 2%;'>:</td>
                <td style='height: 50px; text-align: left; width: calc(100% - 2% -  var(--customWidth));'>" . $row['supplier_id'] . "</td>
            </tr>
            <tr>
                <td style='text-align: right; height: 50px; width: var(--customWidth);'>Medicine Name</td>
                <td style='text-align: center; height: 50px; width: 2%;'>:</td>
                <td style='height: 50px; text-align: left; width: calc(100% - 2% -  var(--customWidth));'>" . $row['m_name'] . "</td>
            </tr>
        </table>
    </a>
    <br>";
} 
} else{
    echo "<center>0 results!</center>";
}
$conn->close();
?>
                    </table>
                    </a>
                    <br>    
                </div>
            </div>
        </body>
        <div class="form-popup" id="uploadForm">
            <form action="07.order.php" method="post" enctype="multipart/form-data" class="form-container">
                <div class="content">
                    <center>
                        <input type="file" class="file-input" id="fileInput" name="file" multiple>
                        <button type="submit" class="form-type" onclick="uploadFiles()">Enter</button>
                        <button type="button" class="form-type" onclick="clearFiles()">Remove</button>
                        <button type="button" class="form-type" onclick="closeForm('uploadForm')">Close</button><br><br>
                    </center>
                    <label for="fileInput" class="inputz" style="color: white; cursor: pointer; background-color: #980328; border: none;">Upload File(s)</label>
                    <br><br>
                    <div id="fileList"></div> 
                </div>
            </form>
        </div>
        
    </div>
    <script>
    function openForm(formId) {
        document.getElementById(formId).style.display = "block";
    }
    
    function closeForm(formId) {
        document.getElementById(formId).style.display = "none";
    }
    
    function uploadFiles() {
    const fileInput = document.getElementById('fileInput');
    const files = fileInput.files;

    if (files.length > 0) {
        const fileListDiv = document.getElementById('fileList');
        fileListDiv.innerHTML = ''; 

        Array.from(files).forEach(file => {
            const fileNameDiv = document.createElement('div');
            fileNameDiv.textContent = file.name;
            fileListDiv.appendChild(fileNameDiv);
        });
        location.reload();  
    } else {
        alert("Please select at least one file.");
    }
}


    function clearFiles() {
        const fileInput = document.getElementById('fileInput');
        fileInput.value = null;

        const fileListSpan = document.getElementById('fileList');
        fileListSpan.textContent = "";
    }
    </script>
<footer>
    <p>MYM Medical © 2024 - All rights reserved.</p>
</footer>
</body>
</html>