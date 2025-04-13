<?php
$host = 'mysql.railway.internal';
$user = 'root';
$pass = 'eIHWhDLjrsSsPUNlNVqOAzDiuIDQdExb';
$dbname = 'railway';

$conn = mysqli_connect($host, $user, $pass, $dbname);
if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}

$username = $_POST['username'];
$password = $_POST['password'];

// Vulnerable query - susceptible to SQL injection
$sql = "SELECT * FROM users WHERE username = '$username' AND password = '$password'";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
  echo "<h2>Welcome, $username!</h2>";
} else {
  echo "<h2>Login failed!</h2>";
}

mysqli_close($conn);
?>
