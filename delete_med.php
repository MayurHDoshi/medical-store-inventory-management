<?php
session_start();

$__db = require __DIR__ . '/config.php';
$servername = $__db['host'];
$username = $__db['user'];
$password = $__db['pass'];
$dbname = $__db['db'];

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $selectedRecords = explode(',', $_POST['selectedRecords']);

    foreach ($selectedRecords as $recordId) {
        $sql = "DELETE FROM medicine WHERE medicine_id = '$recordId'";
        if ($conn->query($sql) !== TRUE) {
            echo "Error deleting record: " . $conn->error;
        }
    }

    $_SESSION['delete_success'] = true;
}
?>