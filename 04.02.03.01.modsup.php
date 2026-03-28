<?php
// Check if supplier_id values are passed in the URL parameters
if(isset($_GET['sup_ids'])) {
    // Retrieve and decode the supplier_id values
    $supIds = json_decode($_GET['sup_ids']);

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

    // Query to fetch data for selected supplier_id values
    $sql = "SELECT * FROM supplier WHERE supplier_id IN (" . implode(',', $supIds) . ")";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Fetch and display data
        while ($row = $result->fetch_assoc()) {
?>
<DOCTYPE html>
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
            color: #788189;
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
    </div><br><br>
    <div class = "main-con">
        <div class = "heading">
            <div class = "header">
                <div class = "heading">
                    <center>
                        <table border="0">
                            <tbody>
                                <tr>
                                    <th><h1>Supplier - Master (Modify)</h2></th>
                                    </tr>
                                </tbody>
                            </table>
                        </center>
                    </div>    
                    <div class="navbar2">
                        <a href="04.02.01.addsup.html">Add</a>
                        <a href="04.02.02.delsup.php">Delete</a>
                        <a href="04.02.03.modsup.php">Modify</a>
                    </div>    
                </div>
            </div> 
            
            <br>
            <div class="content">
            <form id="supplierForm" class="login-form" action="04.02.03.01.update_supplier.php?sup_Ids=<?php echo htmlspecialchars($row['supplier_id']); ?>" method="post">
            <div class = "button">
                <center><button type="submit" id="submit-button" class="submit-button">Update</button></center>        
            </div><br>
                <table>
                    <tr>
                        <td>
                            <div class="form-group">
                                <label for="name">Supplier Name:</label>
                                <input type="text" id="name" name="name" value="<?php echo htmlspecialchars($row['s_name']); ?>"  title="Enter Supplier Name">
                            </div>
                            <div class="form-group">
                                <label for="email">Email:</label>
                                <input type="text" id="email" name="email" value="<?php echo htmlspecialchars($row['s_mail']); ?>"  title="Enter Supplier Mail">
                            </div>
                        </td>
                        <td>
                            <div class="form-group">
                                <label for="address">Address:</label>
                                <input type="text" id="address" name="address" value="<?php echo htmlspecialchars($row['s_address']); ?>"  title="Enter Supplier Address">
                            </div>
                            <div class="form-group">
                                <label for="phone">Phone Number:</label>
                                <input type="number" id="phone" name="phone" value="<?php echo htmlspecialchars($row['s_phoneNo']); ?>"  title="Enter Contact Number">
                            </div>
                        </td>
                        <!-- Add hidden input field to store supplier_id -->
                        <input type="hidden" name="supplier_id" value="<?php echo htmlspecialchars($row['supplier_id']); ?>">
                        <div class="form-group">
                            
                        </div>
                    </tr>
                </table>
                
            </form>
        </div>
    </div>
    <script>
document.addEventListener('DOMContentLoaded', function () {
    const form = document.getElementById('supplierForm');

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

        // Validate email format
        const emailInput = document.getElementById('email');
        const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        if (!emailRegex.test(emailInput.value)) {
            window.alert("Please enter a valid email address.");
            return;
        }

        // Validate contact number format
        const phoneInput = document.getElementById('phone');
        const phoneRegex = /^\d{10}$/;
        if (!phoneRegex.test(phoneInput.value)) {
            window.alert("Please enter a 10-digit phone number.");
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
        }
    } else {
        echo "No records found for the selected supplier.";
    }

    // Close connection
    $conn->close();
}
?>
