<?php
// Security Incident Reporting System - Display Page
// Group 11 - Cyber Security and Digital Forensics Engineering

$conn = new mysqli('localhost', 'root', '', 'incident_db');

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT * FROM incidents ORDER BY date_reported DESC";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Incident Reports</title>
    <style>
        body { font-family: Arial; margin: 50px; }
        table { width: 100%; border-collapse: collapse; }
        th, td { border: 1px solid #ddd; padding: 10px; text-align: left; }
        th { background: #333; color: white; }
        tr:nth-child(even) { background: #f2f2f2; }
        .status-critical { background: #ffcccc; }
        .status-investigation { background: #ffffcc; }
        .status-resolved { background: #ccffcc; }
        button { padding: 10px; margin: 5px; cursor: pointer; }
    </style>
</head>
<body>
    <h1>📋 Security Incident Reports</h1>
    <a href="register.php">➕ Report New Incident</a> | 
    <a href="search.php">🔍 Search Incident</a>
    
    <br><br>
    
    <table>
        <thead>
            <tr><th>Incident ID</th><th>Title</th><th>Description</th><th>Reporter</th><th>Date</th><th>Status</th></tr>
        </thead>
        <tbody>
            <?php
            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    $status_class = "";
                    if ($row['status'] == "Critical") $status_class = "status-critical";
                    elseif ($row['status'] == "Under Investigation") $status_class = "status-investigation";
                    elseif ($row['status'] == "Resolved") $status_class = "status-resolved";
                    
                    echo "<tr class='$status_class'>";
                    echo "<td>" . $row['incident_id'] . "</td>";
                    echo "<td>" . $row['title'] . "</td>";
                    echo "<td>" . $row['description'] . "</td>";
                    echo "<td>" . $row['reporter'] . "</td>";
                    echo "<td>" . $row['date_reported'] . "</td>";
                    echo "<td>" . $row['status'] . "</td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='6'>No incidents reported yet.</td></tr>";
            }
            ?>
        </tbody>
    </table>
</body>
</html>

<?php $conn->close(); ?>
