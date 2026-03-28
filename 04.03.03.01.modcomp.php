<?php
// Check if company_id value is passed in the URL parameters
if(isset($_GET['comp_id'])) {
    // Retrieve and decode the company_id value
    $compId = $_GET['comp_id'];

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

    // Query to fetch data for selected company_id
    $sql = "SELECT * FROM company WHERE company_id = $compId";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Fetch and display company data
        while ($row = $result->fetch_assoc()) {
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MYM - Company Master</title>
    <link rel="stylesheet" href="00.main.css" />
    <style>
        table {
            width: 100%;
            margin: 0;
            padding: 0;
        }
        footer {
            left: 0;
            bottom: 0;
            width: 100%;
            color: #fff;
            text-align: center;
            padding: 10px 0;
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
                                    <th><h1>Company - Master (Modify)</h2></th>
                                </tr>
                            </tbody>
                        </table>
                    </center>
                </div>
                <div class="navbar2">
                    <a href="04.03.01.addcomp.html">Add</a>
                    <a href="04.03.02.delcomp.php">Delete</a>
                    <a href="04.03.03.modcomp.php">Modify</a>
                </div><br><br>
            </div>
        </div>
        <br>
        <div class="content">
            <form id="companyForm" class="login-form" action="04.03.03.01.update_company.php?comp_id=<?php echo htmlspecialchars($row['company_id']); ?>" method="post">
                <div class="button">
                    <center><button type="submit" id="submit-button" class="submit-button">Update</button></center>
                </div>
                <br>
                <table>
                    <tr>
                        <td>
                            <div class="form-group">
                                <label for="name">Company Name:</label>
                                <input type="text" id="name" name="name" value="<?php echo htmlspecialchars($row['c_name']); ?>" required title="Enter Company Name">
                            </div>
                            <div class="form-group">
                                <label for="contnum">Contact Number:</label>
                                <input type="text" id="contnum" name="contnum" value="<?php echo htmlspecialchars($row['c_phoneNo']); ?>" required title="Enter Contact Number">
                            </div>
                        </td>
                        <td>
                            <div class="form-group">
                                <label for="address">Address:</label>
                                <input type="text" id="address" name="address" value="<?php echo htmlspecialchars($row['c_address']); ?>" required title="Enter Company Address">
                            </div>
                        </td>
                        <!-- Add hidden input field to store company_id -->
                        <input type="hidden" name="company_id" value="<?php echo htmlspecialchars($row['company_id']); ?>">
                        <div class="form-group">

                        </div>
                    </tr>
                </table>

            </form>
        </div>
    </div>

    <script>
document.addEventListener('DOMContentLoaded', function () {
    const form = document.getElementById('companyForm');

    form.addEventListener('submit', function (event) {
        event.preventDefault();

        // Check if all fields are filled
        const inputs = form.querySelectorAll('input[type="text"]');
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

        // Validate contact number format
        const contactNumberInput = document.getElementById('contnum');
        const contactNumberRegex = /^\d{10}$/;
        if (!contactNumberRegex.test(contactNumberInput.value)) {
            window.alert("Please enter a 10-digit contact number.");
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
        echo "No records found for the selected company.";
    }

    // Close connection
    $conn->close();
}
?>
