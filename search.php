<?php
                        $username = "mym";
                        $servername = "localhost";
                        $password = "mym123";
                        $dbname = "mym";

                        $conn = new mysqli($servername, $username, $password, $dbname);

                        if ($conn->connect_error) {
                            die("Connection failed: " . $conn->connect_error);
                        }

// Construct your SQL query based on the form inputs
$sql = "SELECT * FROM your_table WHERE 1"; // Initial SQL query

// Check each input field and add corresponding conditions to the SQL query
if (!empty($_POST['search_name'])) {
    $search_name = $conn->real_escape_string($_POST['search_name']);
    $sql .= " AND name LIKE '%$search_name%'";
}

if (!empty($_POST['search_id'])) {
    $search_id = $conn->real_escape_string($_POST['search_id']);
    $sql .= " AND id LIKE '%$search_id%'";
}

if (!empty($_POST['search_price'])) {
    $search_price = $conn->real_escape_string($_POST['search_price']);
    $sql .= " AND price LIKE '%$search_price%'";
}

if (!empty($_POST['search_packaging'])) {
    $search_packaging = $conn->real_escape_string($_POST['search_packaging']);
    $sql .= " AND packaging LIKE '%$search_packaging%'";
}

if (!empty($_POST['search_company'])) {
    $search_company = $conn->real_escape_string($_POST['search_company']);
    $sql .= " AND company LIKE '%$search_company%'";
}

if (!empty($_POST['search_composition'])) {
    $search_composition = $conn->real_escape_string($_POST['search_composition']);
    $sql .= " AND composition LIKE '%$search_composition%'";
}

// Execute the SQL query and fetch results
$result = $conn->query($sql);

// Build the HTML table with search results
if ($result->num_rows > 0) {
    // Start building table rows
    $tableRows = '';
    while ($row = $result->fetch_assoc()) {
        $tableRows .= "<tr>";
        // Construct table cells for each field
        $tableRows .= "<td>" . $row['name'] . "</td>";
        $tableRows .= "<td>" . $row['id'] . "</td>";
        $tableRows .= "<td>" . $row['price'] . "</td>";
        $tableRows .= "<td>" . $row['quantity'] . "</td>";
        $tableRows .= "<td>" . $row['packaging'] . "</td>";
        $tableRows .= "<td>" . $row['company'] . "</td>";
        // Add cells for other fields similarly
        $tableRows .= "</tr>";
    }
    echo $tableRows; // Output the HTML table rows
} else {
    echo "<tr><td colspan='7'>No results found</td></tr>";
}

$conn->close();
?>
