<?php
session_start();
require_once 'includes/db.php';

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Dashboard - Security Incident System</title>
    <style>
        body { font-family: Arial; margin: 50px; }
        .container { width: 800px; margin: auto; }
        .menu { background: #333; padding: 15px; color: white; }
        .menu a { color: white; margin-right: 20px; text-decoration: none; }
        .welcome { background: #e0e0e0; padding: 20px; border-radius: 10px; margin-top: 20px; }
    </style>
</head>
<body>
    <div class="container">
        <div class="menu">
            <a href="dashboard.php">🏠 Home</a>
            <a href="register.php">📝 Report Incident</a>
            <a href="display.php">📋 View Incidents</a>
            <a href="search.php">🔍 Search</a>
            <a href="logout.php" style="float:right;">🚪 Logout</a>
        </div>
        
        <div class="welcome">
            <h2>Welcome, <?php echo $_SESSION['username']; ?>!</h2>
            <p>Role: <?php echo $_SESSION['role']; ?></p>
            <p>This is the Security Incident Reporting System for Tanzania.</p>
            <hr>
            <h3>Quick Actions:</h3>
            <ul>
                <li><a href="register.php">Report a new security incident</a></li>
                <li><a href="display.php">View all incident reports</a></li>
                <li><a href="search.php">Search incident by ID</a></li>
            </ul>
        </div>
    </div>
</body>
</html>
