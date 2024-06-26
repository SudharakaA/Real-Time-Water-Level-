<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "try";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get the gauge ID to delete
$gaugeId = $_GET['gauge_id'];

// SQL to delete record
$sql = "DELETE FROM water_gauge WHERE gauge_id=$gaugeId";

if ($conn->query($sql) === TRUE) {
    echo "Record deleted successfully";
} else {
    echo "Error deleting record: " . $conn->error;
}

$conn->close();
?>
