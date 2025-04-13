<?php
// Correct Database Credentials for Railway MySQL Database
$host = 'mysql.railway.internal';
$user = 'root';
$pass = 'eIHWhDLjrsSsPUNlNVqOAzDiuIDQdExb';
$dbname = 'railway';

// Connect to the Railway MySQL Database
$conn = mysqli_connect($host, $user, $pass, $dbname);

if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}

// Check if users table exists, and if not, create it
$table_check_query = "SHOW TABLES LIKE 'users'";
$table_check_result = mysqli_query($conn, $table_check_query);

if (mysqli_num_rows($table_check_result) == 0) {
    $create_table_query = "
        CREATE TABLE users (
            id INT AUTO_INCREMENT PRIMARY KEY,
            username VARCHAR(100) NOT NULL,
            password VARCHAR(255) NOT NULL
        );
    ";
    if (!mysqli_query($conn, $create_table_query)) {
        die("Error creating table: " . mysqli_error($conn));
    }
}

// Now insert the new user
$username = mysqli_real_escape_string($conn, $_POST['username']);
$password = password_hash($_POST['password'], PASSWORD_DEFAULT); // Password hashing

$insert_query = "INSERT INTO users (username, password) VALUES ('$username', '$password')";

if (mysqli_query($conn, $insert_query)) {
    echo "<h2>Signup successful!</h2><p><a href='index.html'>Go to Login</a></p>";
} else {
    echo "<h2>Error: " . mysqli_error($conn) . "</h2>";
}

mysqli_close($conn);
?>
