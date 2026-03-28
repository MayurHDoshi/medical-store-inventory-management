<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MYM - Company Master</title>
    <link rel="stylesheet" href="00.main.css" />
    <style>
        tr,
        td {
            --customWidth: 17%;
        }
        footer {
            left: 0;
            bottom: 0;
            width: 100%;
            color: #fff;
            text-align: center;
            padding: 10px 0;
        }
        .content table {
            border: 1px solid;
            border-radius: 10px;
            margin: 0.8%;
        }

        input[type="checkbox"] {
            margin: 10px;
            padding: 0;
            box-sizing: border-box;
            height: 2.5vh;
            width: 2.5vh;
            color: rgb(0, 0, 0);
        }
        input[type="submit"]{
            background-color: #000000;
            color: #F0F5F9;
            border: none;
            cursor: pointer;
            border-radius: 5px;
            width: 11vw;
            height: 7vh;
            font-size: 1.25rem;
            font-family: 'CP';
        }
        .inputz {
            color: #788189;
            background-color: white;
            width: 25vw;
            height: 4vh;
            border-radius: 3px;
            font-family: 'CP';
            border-style: solid;
            padding: 9px;
        }

        .form-type {
            background-color: #000000;
            padding: 0px;
            margin-bottom: 0px;
            margin-top: 0px;
            margin-left: 0px;
            margin-right: 0px;
            color: #f0f5f9;
            border: none;
            border-radius: 3px;
            cursor: pointer;
            display: inline-block;
            border-radius: 5px;
            cursor: pointer;
            width: 100px;
            height: 30px;
            font-size: medium;
            font-family: 'CP';
        }
        #confirmButton:disabled {
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
                                        <h1>Company - Master (Delete)</h2>
                                    </th>
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
            </div><br><br>
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
            <center><button id="confirmButton" disabled>Confirm</button></center><br>
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

        if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['recordsToDelete'])) {
            $recordsToDelete = $_POST['recordsToDelete'];

            foreach ($recordsToDelete as $record) {
                $sql = "DELETE FROM company WHERE company_id = ?";
                $stmt = $conn->prepare($sql);
                $stmt->bind_param("s", $record);
                if (!$stmt->execute()) {
                    echo "Error deleting record: " . $stmt->error;
                }
            }

            echo "<center>Record(s) deleted successfully!</center><br>";
        }

        $search = "";

        if (isset($_POST['search']) && !empty($_POST['search'])) {
            $search = $_POST['search'];
            $sql = "SELECT company_id, c_name, c_address, c_phoneNo FROM company 
                    WHERE company_id LIKE '%$search%' OR c_name LIKE '%$search%'  OR c_address LIKE '%$search%' OR c_phoneNo LIKE '%$search%'";
        } else {
            $sql = "SELECT company_id, c_name, c_address, c_phoneNo FROM company";
        }

        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            echo '<form id="deleteForm" method="post">';
            $formCounter = 1;
            while ($row = $result->fetch_assoc()) {
                echo "
                <table border='0'>
                    <tr>
                        <td rowspan='5'><input type='checkbox' name='recordsToDelete[]' value='" . $row['company_id'] . "'></td>
                        <td style='text-align: right; height: 50px; width: var(--customWidth);'>Company ID</td>
                        <td style='text-align: center; height: 50px; width: 2%;'>:</td>
                        <td style='height: 50px; width: calc(100% - 2% - var(--customWidth));'>" . $row['company_id'] . "</td>
                    </tr>
                    <tr>
                        <td style='text-align: right; height: 50px; width: var(--customWidth);'>Company Name</td>
                        <td style='text-align: center; height: 50px; width: 2%;'>:</td>
                        <td style='height: 50px; width: calc(100% - 2% - var(--customWidth));'>" . $row['c_name'] . "</td>
                    </tr>
                    <tr>
                        <td style='text-align: right; height: 50px; width: var(--customWidth);'>Company Address</td>
                        <td style='text-align: center; height: 50px; width: 2%;'>:</td>
                        <td style='height: 50px; width: calc(100% - 2% - var(--customWidth));'>" . $row['c_address'] . "</td>
                    </tr>
                    <tr>
                        <td style='text-align: right; height: 50px; width: var(--customWidth);'>Contact No.</td>
                        <td style='text-align: center; height: 50px; width: 2%;'>:</td>
                        <td style='height: 50px; width: calc(100% - 2% - var(--customWidth));'>" . $row['c_phoneNo'] . "</td>
                    </tr>
                </table>
                <br>";
                $formCounter++;
            }
            echo '</form>';
        } else {
            echo "<center>No results found!</center>";
        }
        $conn->close();
        ?>
        <br> 
        </div>   
        <script>
        document.addEventListener('DOMContentLoaded', function() {
            const checkboxes = document.querySelectorAll('input[type="checkbox"]');
            const confirmButton = document.getElementById('confirmButton');

            checkboxes.forEach(checkbox => {
                checkbox.addEventListener('change', function() {
                    const atLeastOneChecked = Array.from(checkboxes).some(cb => cb.checked);
                    confirmButton.disabled = !atLeastOneChecked;
                });
            });

            confirmButton.addEventListener('click', function() {
                const confirmed1 = window.confirm("You are about to delete selected records from the database!");
                if (!confirmed1) {
                    return;
                }

                let password = 'pass@123'; // Default password
                let authenticated = false;
                while (!authenticated) {
                    const userInput = prompt("Please enter the password:");
                    if (userInput === password) {
                        authenticated = true;
                        document.getElementById('deleteForm').submit();
                    } else {
                        const retry = window.confirm("Wrong Password! Do you want to retry?");
                        if (!retry) {
                            return;
                        }
                    }
                }
            });
        });
        </script>
<footer>
    <p>MYM Medical © 2024 - All rights reserved.</p>
</footer>
</body>
</html>