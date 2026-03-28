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

        input[type="submit"] {
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
            cursor: pointer;
            display: inline-block;
            border-radius: 5px;
            width: 100px;
            height: 30px;
            font-size: medium;
            font-family: 'CP';
        }

        .fixed-button:disabled {
            cursor: not-allowed;
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
    <div class="main-con">
        <div class="heading">
            <div class="header">
                <div class="heading">
                    <center>
                        <table border="0">
                            <tbody>
                                <tr>
                                    <th>
                                        <h1>Company - Master (Modify)</h2>
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
            <center><button class="fixed-button" disabled onclick="handleButtonClick()">Confirm</button></center><br>
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
                        <td rowspan='5'><input type='checkbox' value='" . $row['company_id'] . "'></td>
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
    </div>

    <script>
        function handleButtonClick() {
            var checkedCheckbox = document.querySelector('input[type="checkbox"]:checked');
            if (checkedCheckbox) {
                var url = "04.03.03.01.modcomp.php?comp_id=" + encodeURIComponent(checkedCheckbox.value);
                window.location.href = url;
            } else {
                alert("Please select a company.");
            }
        }

        document.addEventListener('DOMContentLoaded', function () {
            const checkboxes = document.querySelectorAll('input[type="checkbox"]');
            const confirmButton = document.querySelector('.fixed-button');

            checkboxes.forEach(checkbox => {
                checkbox.addEventListener('change', function () {
                    checkboxes.forEach(cb => {
                        if (cb !== checkbox) {
                            cb.checked = false; // Uncheck other checkboxes
                        }
                    });
                    confirmButton.disabled = !this.checked; // Enable/disable confirm button based on checkbox state
                });
            });
        });
    </script>

<footer>
    <p>MYM Medical © 2024 - All rights reserved.</p>
</footer>
</body>
</html>
