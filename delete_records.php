<?php
session_start();

$servername = "localhost";
$username = "mym";
$password = "mym123";
$dbname = "mym";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $selectedRecords = explode(',', $_POST['selectedRecords']);

    // Inspect POST data
    var_dump($_POST['selectedRecords']);

    foreach ($selectedRecords as $recordId) {
        $sql = "DELETE FROM medicine WHERE medicine_id = $recordId";
        if ($conn->query($sql) !== TRUE) {
            echo "Error deleting record: " . $conn->error;
        }
    }
    // Set session variable to indicate successful deletion
    $_SESSION['delete_success'] = true;

    // Redirect back to test3.php after deletion
    header("Location: test3.php");
    exit();
}
?>
