<?php
// Start the session
session_start();

// Create a connection to the MySQL database
$conn = new mysqli('localhost', 'root', '', 'siteattendance');

// Check for connection error
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Admin details (replace with actual data or form inputs)
$name = 'Admin Name'; // The name of the admin
$email = 'admin@gmail.com'; // The email of the admin
$password = 'admin123'; // The password (plaintext)

// Hash the password using bcrypt
$hashed_password = password_hash($password, PASSWORD_DEFAULT);

// SQL query to insert an admin account into the `admins` table
$sql = "INSERT INTO admins (name, email, password, role) VALUES (?, ?, ?, ?)";

// Prepare the SQL query
$stmt = $conn->prepare($sql);

// Bind parameters to the query (name, email, hashed_password, role)
$role = 'admin'; // Assigning the role as 'admin'
$stmt->bind_param("ssss", $name, $email, $hashed_password, $role);

// Execute the query
if ($stmt->execute()) {
    echo "Admin account created successfully!";
} else {
    echo "Error: " . $stmt->error;
}

// Close the statement and connection
$stmt->close();
$conn->close();
?>
