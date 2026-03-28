<?php
// 03.01.update.inventory.php

// Check if the request method is POST
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Decode the JSON data received from the client
    $data = json_decode(file_get_contents("php://input"), true);

    // Connect to your database
    $servername = "localhost";
    $username = "mym";
    $password = "mym123";
    $dbname = "mym";

    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die(json_encode(["error" => "Connection failed: " . $conn->connect_error]));
    }

    // Assuming your inventory table is named 'inventory'
    foreach ($data as $item) {
        $medicineId = $item['id']; // Change 'id' to 'medicine_id'
        $quantity = $item['quantity'];

        // Check if there's enough quantity in inventory
        $checkQuantityQuery = "SELECT quantity FROM inventory WHERE medicine_id = '$medicineId'";
        $checkResult = $conn->query($checkQuantityQuery);
        if ($checkResult->num_rows > 0) {
            $row = $checkResult->fetch_assoc();
            $currentQuantity = $row['quantity'];
            if ($currentQuantity < $quantity) {
                echo json_encode(["error" => "Not enough quantity available for medicine with ID $medicineId"]);
                exit;
            }
        } else {
            echo json_encode(["error" => "Medicine with ID $medicineId not found in inventory"]);
            exit;
        }

        // Perform update operation on the inventory table
        // For example, subtract the quantity from the inventory for the given medicine ID
        $sql = "UPDATE inventory SET quantity = quantity - $quantity WHERE medicine_id = '$medicineId'";
       
        if ($conn->query($sql) !== TRUE) {
            echo json_encode(["error" => "Error updating inventory: " . $conn->error]);
            exit;
        }
    }

    // Close the database connection
    $conn->close();

    // Return success message
    echo json_encode(["success" => "Inventory updated successfully"]);
    exit;
} else {
    // If the request method is not POST, return an error
    http_response_code(405); // Method Not Allowed
    echo json_encode(["error" => "Only POST requests are allowed."]);
    exit;
}
?>
