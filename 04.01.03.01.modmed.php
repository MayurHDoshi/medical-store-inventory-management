<?php
        // Check if medicine_id value is passed in the URL parameters
        if(isset($_GET['med_ids'])) {
            // Retrieve and decode the medicine_id value
            $medId = $_GET['med_ids'];

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

            // Query to fetch data for selected medicine_id
            $sql = "SELECT * FROM medicine WHERE medicine_id = $medId";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                // Fetch and display medicine data
                $row = $result->fetch_assoc();
        ?>
<!DOCTYPE html>
<html lang="en">
 
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MYM - Medicine Master</title>
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
        footer {
            left: 0;
            bottom: 0;
            width: 100%;
            color: #fff;
            text-align: center;
            padding: 10px 0;
        }
        .form-group label {
            margin-bottom: 5px;
            color: #788189;
            display: block;
        }
 
        .form-group input {
            padding: 15px;
            border: 2px solid #ccc;
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
                                    <th><h1>Medicine - Master (Modify)</h2></th>
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
            </div> <br> <br>
        <div class = "content">
            <form id="medicineForm" class="login-form" action="04.01.03.01.update_medicine.php?med_ids=<?php echo htmlspecialchars($row['medicine_id']); ?>" method="post">
            <div class = "button">
                <center><button type="submit" id="submit-button" class="submit-button">Enter</button></center>        
            </div>
            <br>
                <table border="0">
                    <tr style="text-align: left;" >
                        <td>
                            <div class="form-group">
                                <label for="name">Name:</label>
                                <input type="text" id="name" name="name" value="<?php echo htmlspecialchars($row['m_name']); ?>" required title="Enter Medicine Name">                            </div>
                            <div class="form-group">
                                <label for="location">Location:</label>
                                <input type="text" id="location" name="location" value="<?php echo htmlspecialchars($row['m_location']); ?>" required title="Enter Medicine Code">
                            </div>
                            <div class="form-group">
                                <label for="packaging">Packaging:</label>
                                <input type="text" id="packaging" name="packaging" value="<?php echo htmlspecialchars($row['m_packaging']); ?>" required title="Enter packaging of Medicines">
                            </div>
                        </td>
                        <td>
                            <div class="form-group">
                                <label for="gencomp">Generic Composition:</label>
                                <input type="text" id="gencomp" name="gencomp" value="<?php echo htmlspecialchars($row['m_composition']); ?>" required title="Enter Medicine gencomp">
                            </div>
                            <div class="form-group">
                                <label for="company">Company ID:</label>
                                <input type="number" id="company" name="company" value="<?php echo htmlspecialchars($row['company_id']); ?>" requiredtitle="Enter company">
                            </div>
                            <div class="form-group">
                                <label for="price">Price:</label>
                                <input type="number" id="price" name="price" step="any" min = "0" value="<?php echo htmlspecialchars($row['m_mrp']); ?>" required title="Enter Medicine Price">
                            </div>
                        </td>
                    </tr>
                    </table>
        </div>    
    </div>
    <script>
    document.addEventListener('DOMContentLoaded', function () {
        const form = document.getElementById('medicineForm');

        form.addEventListener('submit', function (event) {
            event.preventDefault();

            // Check if all fields are filled
            const inputs = form.querySelectorAll('input[type="text"], input[type="number"]');
            let allFieldsFilled = true;
            inputs.forEach(input => {
                if (!input.value.trim()) {
                    allFieldsFilled = false;
                }
            });

            if (!allFieldsFilled) {
                window.alert("Please fill out all fields.");
                return;
            }

            const confirmed1 = window.confirm("You are about to modify a master in the database!");
            if (!confirmed1) {
                return;
            }

            let passwordAttempts = 0;
            let password;
            while (password !== "pass@123") {
                password = prompt("Enter password:");
                if (password === null) { // User clicked Cancel
                    window.location.reload(); // Reload the page
                    return;
                }
                passwordAttempts++;
                if (password !== "pass@123" && passwordAttempts < 3) {
                    const retry = confirm("Wrong Password! Do you want to retry?");
                    if (!retry) {
                        window.location.reload(); // Reload the page
                        return;
                    }
                } else if (passwordAttempts === 3) {
                    window.alert("Too many incorrect attempts. Please try again later.");
                    window.location.reload(); // Reload the page
                    return;
                }
            }

            // If password is correct, show success message and submit the form
            window.alert("Master Modified!");
            form.submit();
        });
    });
</script>
<footer>
    <p>MYM Medical © 2024 - All rights reserved.</p>
</footer>
</body>
</html>
<?php
    } else {
        echo "No records found for the selected medicine.";
    }

    // Close connection
    $conn->close();
}
?>