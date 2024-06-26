<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "try";

$conn = new mysqli($servername, $username, $password, $dbname);

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $gauge_id = $_POST['gauge_id'];
    $station_name = $_POST['station_name'];
    $gauge_entered_by = $_POST['gauge_entered_by'];
    $gauge_collected_by = $_POST['gauge_collected_by'];
    $gauge_date = $_POST['gauge_date'];
    $gauge_time = $_POST['gauge_time'];
    $water_level = $_POST['water_level'];

    // Perform update query
    $sql = "UPDATE water_gauge SET 
            station_name = '$station_name',
            gauge_entered_by = '$gauge_entered_by',
            gauge_collected_by = '$gauge_collected_by',
            gauge_date = '$gauge_date',
            gauge_time = '$gauge_time',
            water_level = '$water_level'
            WHERE gauge_id = '$gauge_id'";

    if ($conn->query($sql) === TRUE) {
        echo "Record updated successfully";
    } else {
        echo "Error updating record: " . $conn->error;
    }

    // Close the database connection
    $conn->close();
} else {
    // Fetch the data to populate the form fields
    $gauge_id = $_GET['id']; // Assuming the ID is passed through URL parameter

    // Perform a query to fetch the data based on the provided ID
    $sql = "SELECT * FROM water_gauge WHERE gauge_id = '$gauge_id'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Fetch the data
        $row = $result->fetch_assoc();
        // Store the fetched data in variables
        $station_name = $row['station_name'];
        $gauge_entered_by = $row['gauge_entered_by'];
        $gauge_collected_by = $row['gauge_collected_by'];
        $gauge_date = $row['gauge_date'];
        $gauge_time = $row['gauge_time'];
        $water_level = $row['water_level'];
    } else {
        echo "No record found";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Entered Data</title>
</head>
<body>
    <h2>Edit Entered Data</h2>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <input type="hidden" name="gauge_id" value="<?php echo $gauge_id; ?>">
        <label for="station_name">Station Name:</label>
        <input type="text" name="station_name" value="<?php echo $station_name; ?>" required><br><br>
        
        <label for="gauge_entered_by">Gauge Entered Person Name:</label>
        <input type="text" name="gauge_entered_by" value="<?php echo $gauge_entered_by; ?>" required><br><br>

        <label for="gauge_collected_by">Gauge Collected Person Name:</label>
        <input type="text" name="gauge_collected_by" value="<?php echo $gauge_collected_by; ?>" required><br><br>
        
        <label for="gauge_date">Gauge Collected Date:</label>
        <input type="date" name="gauge_date" value="<?php echo $gauge_date; ?>" required><br><br>
        
        <label for="gauge_time">Gauge Collected Time:</label>
        <input type="time" name="gauge_time" value="<?php echo $gauge_time; ?>" required><br><br>
        
        <label for="water_level">Water Level:</label>
        <input type="number" name="water_level" value="<?php echo $water_level; ?>" step="any" required><br><br>
        
        <input type="submit" value="Update">
    </form>
</body>
</html>
