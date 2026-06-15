<?php
// Security Incident Reporting System - Search Page
// Group 11 - Cyber Security and Digital Forensics Engineering

$conn = new mysqli('localhost', 'root', '', 'incident_db');

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$result = null;
$search_id = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $search_id = $_POST['incident_id'];
    $sql = "SELECT * FROM incidents WHERE incident_id LIKE '%$search_id%'";
    $result = $conn->query($sql);
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Search Incident</title>
    <style>
        body { font-family: Arial; margin: 50px; }
        .container { width: 800px; margin: auto; }
        input, button { padding: 10px; margin: 10px 0; }
        input { width: 70%; }
        button { background: blue; color: white; border: none; cursor: pointer; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid #ddd; padding: 10px; text-align: left; }
        th { background: #333; color: white; }
    </style>
</head>
<body>
    <div class="container">
        <h1>🔍 Search Security Incident</h1>
        <a href="register.php">➕ Report New Incident</a> | 
        <a href="display.php">📋 View All Incidents</a>
        
        <br><br>
        
        <form method="POST">
            <label>Enter Incident ID:</label>
            <input type="text" name="incident_id" placeholder="Example:SEC-24021623-012" value="<?php echo $search_id; ?>">
            <button type="submit">Search</button>
        </form>
        
        <?php if ($result && $result->num_rows > 0): ?>
            <h3>Search Results:</h3>
            <table>
                <thead>
                    <tr><th>Incident ID</th><th>Title</th><th>Description</th><th>Status</th><th>Date</th></tr>
                </thead>
                <tbody>
                    <?php while($row = $result->fetch_assoc()): ?>
                    <tr>
                        <td><?php echo $row['incident_id']; ?></td>
                        <td><?php echo $row['title']; ?></td>
                        <td><?php echo $row['description']; ?></td>
                        <td><?php echo $row['status']; ?></td>
                        <td><?php echo $row['date_reported']; ?></td>
                    </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        <?php elseif ($_SERVER['REQUEST_METHOD'] == 'POST'): ?>
            <p style="color:red;">❌ No incident found with ID: <?php echo $search_id; ?></p>
        <?php endif; ?>
    </div>
</body>
</html>

<?php $conn->close(); ?>
