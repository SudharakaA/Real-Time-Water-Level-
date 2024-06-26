<?php
// Connect to the database
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "try";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch data from the water_gauge table
$sql = "SELECT gauge_date, water_level FROM water_gauge";
$result = $conn->query($sql);

$data = [];

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $data[] = $row;
    }
}

$conn->close();

// Process the data as needed for analysis
// For example, calculate average water level per day
$averageData = [];
foreach ($data as $entry) {
    $date = $entry['gauge_date'];
    $waterLevel = $entry['water_level'];
    if (!isset($averageData[$date])) {
        $averageData[$date] = ['count' => 1, 'total' => $waterLevel];
    } else {
        $averageData[$date]['count']++;
        $averageData[$date]['total'] += $waterLevel;
    }
}

$finalData = [];
foreach ($averageData as $date => $values) {
    $finalData[$date] = $values['total'] / $values['count'];
}

// Output data in JSON format
echo json_encode($finalData);
?>
