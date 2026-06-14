<?php
// Security Incident Reporting System - Registration Page
// Group 11 - Cyber Security and Digital Forensics Engineering

// Database connection
$conn = new mysqli('localhost', 'root', '', 'incident_db');

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Handle form submission
$message = "";
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $title = $_POST['title'];
    $description = $_POST['description'];
    $reporter = $_POST['reporter'];
    $date = date('Y-m-d H:i:s');
    
    // Generate unique Incident ID
    $incident_id = 'SEC-' . date('Ymd') . '-' . rand(100, 999);
    
    $sql = "INSERT INTO incidents (incident_id, title, description, reporter, date_reported, status) 
            VALUES ('$incident_id', '$title', '$description', '$reporter', '$date', 'Under Investigation')";
    
    if ($conn->query($sql) === TRUE) {
        $message = "<div style='color:green;'>✅ Incident registered successfully!<br>Incident ID: <strong>$incident_id</strong></div>";
    } else {
        $message = "<div style='color:red;'>❌ Error: " . $conn->error . "</div>";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Report Security Incident</title>
    <style>
        body { font-family: Arial; margin: 50px; }
        input, textarea, select { width: 100%; padding: 10px; margin: 10px 0; }
        button { background: blue; color: white; padding: 10px 20px; border: none; cursor: pointer; }
        .container { width: 500px; margin: auto; border: 1px solid #ccc; padding: 20px; border-radius: 10px; }
    </style>
</head>
<body>
    <div class="container">
        <h1>🔐 Report Security Incident</h1>
        <?php echo $message; ?>
        <form method="POST">
            <label>Incident Title:</label>
            <input type="text" name="title" required>
            
            <label>Description:</label>
            <textarea name="description" rows="5" required></textarea>
            
            <label>Reporter Name:</label>
            <input type="text" name="reporter" required>
            
            <button type="submit">Submit Report</button>
        </form>
        <br>
        <a href="display.php">View All Incidents</a> | 
        <a href="search.php">Search Incident</a>
    </div>
</body>
</html>
