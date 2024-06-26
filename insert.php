<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "try";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$station_name = $_POST['station_name'];
$gauge_entered_by = $_POST['gauge_entered_by'];
$gauge_collected_by = $_POST['gauge_collected_by'];
$gauge_date = $_POST['gauge_date'];
$gauge_time = $_POST['gauge_time'];
$water_level = $_POST['water_level'];

$sql = "INSERT INTO water_gauge (station_name, gauge_entered_by, gauge_collected_by, gauge_date, gauge_time, water_level) 
        VALUES ('$station_name', '$gauge_entered_by', '$gauge_collected_by', '$gauge_date', '$gauge_time', '$water_level')";

if ($conn->query($sql) === TRUE) {
    echo "Water level inserted successfully";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>
