<?php
// Database connection
$servername = "sql113.infinityfree.com";
$username = "if0_40148312";
$password = "Register890";
$dbname = "if0_40148312_Mydatabase";

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$username = mysqli_real_escape_string($conn, $_POST['username']);
$email = mysqli_real_escape_string($conn, $_POST['email']);
$password = password_hash($_POST['password'], PASSWORD_DEFAULT); // hash password

// Check if user already exists
$sql = "SELECT * FROM userdata WHERE email='$email'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo "<h3>Email already registered!</h3>";
    echo "<p><a href='login.html'>Login here</a></p>";
} else {
    $insert = "INSERT INTO userdata (username, email, password) VALUES ('$username', '$email', '$password')";
    if ($conn->query($insert) === TRUE) {
        echo "<h3>Registration successful!</h3>";
        echo "<p><a href='login.html'>Login now</a></p>";
    } else {
        echo "Error: " . $conn->error;
    }
}

$conn->close();
?>
