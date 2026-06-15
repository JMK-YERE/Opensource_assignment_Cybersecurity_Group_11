-- Security Incident Reporting System Database
-- Group 11 - Cyber Security and Digital Forensics Engineering

CREATE DATABASE IF NOT EXISTS incident_db;
USE incident_db;

-- Incidents table
CREATE TABLE IF NOT EXISTS incidents (
    id INT AUTO_INCREMENT PRIMARY KEY,
    incident_id VARCHAR(50) UNIQUE NOT NULL,
    title VARCHAR(200) NOT NULL,
    description TEXT NOT NULL,
    reporter VARCHAR(100) NOT NULL,
    date_reported DATETIME NOT NULL,
    status ENUM('Under Investigation', 'Critical', 'Resolved', 'Closed') DEFAULT 'Under Investigation'
);

-- Users table for authentication
CREATE TABLE IF NOT EXISTS users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) UNIQUE NOT NULL,
    email VARCHAR(100) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL,
    role ENUM('admin', 'reporter') DEFAULT 'reporter',
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP
);

-- Default admin user (password: admin123)
INSERT INTO users (username, email, password, role) VALUES
('admin','JOSEPH', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'admin');

-- Sample incidents
INSERT INTO incidents (incident_id, title, description, reporter, date_reported, status) VALUES
('001', 'Data Breach', 'Customer database accessed by unauthorized user', 'Baharia nkasi', NOW(), 'Critical'),
('002', 'Phishing Attack', 'Employees received suspicious emails', 'Jackline', NOW(), 'Under Investigation'),
('003', 'Ransomware Attempt', 'Ransomware detected but blocked', 'dominick', NOW(), 'Resolved');
