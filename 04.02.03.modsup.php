<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="00.main.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MYM - Supplier Master</title>
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
        .fixed-button:disabled {
            cursor: not-allowed;
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
        input[type="checkbox"] {
            margin: 10px;
            padding: 0;
            box-sizing:border-box;
            height: 2.5vh; 
            width: 2.5vh;
            color: rgb(0, 0, 0);
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
                <table border="0">
                    <tbody> 
                        <tr>
                            <th colspan="2"><h1>Supplier - Master (Modify)</h1></th>
                        </tr>
                    </tbody>
                </table>
            </center>
        </div>
        <div class="navbar2">
            <a href="04.02.01.addsup.html">Add</a>
            <a href="04.02.02.delsup.php">Delete</a>
            <a href="04.02.03.modsup.php">Modify</a>
        </div><br><br><br>
        <table align="center">
            <tr align="center">
                <td>
                    <form style="height: 50px; vertical-align: middle;" method="post">
                        <input class="inputz" type="text" id="search" name="search">
                        <button class="form-type" type="submit">Search</button>
                    </form>
                </td>
            </tr>
        </table><br>
        <center><button class="fixed-button" disabled onclick="handleButtonClick()">Confirm</button></center><br>

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
                            <td rowspan='5'><input type='checkbox' value='" . $row['supplier_id'] . "'></td>
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
        </div>    
    </div>          

    <script>
    function handleButtonClick() {
        var checkedCheckbox = document.querySelector('input[type="checkbox"]:checked');
        if (checkedCheckbox) {
            var url = "04.02.03.01.modsup.php?sup_ids=" + encodeURIComponent(JSON.stringify([checkedCheckbox.value]));
            window.location.href = url;
        } else {
            alert("Please select a supplier.");
        }
    }

    // Add event listener to checkboxes
    var checkboxes = document.querySelectorAll('input[type="checkbox"]');
    checkboxes.forEach(function(checkbox) {
        checkbox.addEventListener('change', handleCheckboxSelection);
    });

    function handleCheckboxSelection() {
        var checked = document.querySelector('input[type="checkbox"]:checked');
        var button = document.querySelector('.fixed-button');
        button.disabled = !checked;

        // Uncheck all other checkboxes
        checkboxes.forEach(function(checkbox) {
            if (checkbox !== checked) {
                checkbox.checked = false;
            }
        });
    }
</script>
<footer>
    <p>MYM Medical © 2024 - All rights reserved.</p>
</footer>

</body>
</html>
    