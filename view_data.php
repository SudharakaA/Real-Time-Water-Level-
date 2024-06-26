<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Entered Data</title>
    <style>
        /* Your CSS styles */
    </style>
</head>
<body>
    <div class="container">
        <h2>Entered Data</h2>
        <table border="1">
            <thead>
                <tr>
                    <th>Gauge ID</th>
                    <th>Station Name</th>
                    <th>Gauge Entered By</th>
                    <th>Gauge Collected By</th>
                    <th>Gauge Date</th>
                    <th>Gauge Time</th>
                    <th>Water Level</th>
                </tr>
            </thead>
            <tbody>
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

                // Fetch data from database
                $sql = "SELECT * FROM water_gauge";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    // Output data of each row
                    while($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>".$row["gauge_id"]."</td>";
                        echo "<td>".$row["station_name"]."</td>";
                        echo "<td>".$row["gauge_entered_by"]."</td>";
                        echo "<td>".$row["gauge_collected_by"]."</td>";
                        echo "<td>".$row["gauge_date"]."</td>";
                        echo "<td>".$row["gauge_time"]."</td>";
                        echo "<td>".$row["water_level"]."</td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='7'>No data found</td></tr>";
                }
                $conn->close();
                ?>
            </tbody>
        </table>
    </div>
</body>
</html>
