<?php
session_start();

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

$email = mysqli_real_escape_string($conn, $_POST['email']);
$password = $_POST['password'];

// Check if user exists
$sql = "SELECT * FROM userdata WHERE email='$email' OR username='$email'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $user = $result->fetch_assoc();

    // Verify password
    if (password_verify($password, $user['password'])) {
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['username'] = $user['username'];
        header("Location: dashboard.php");
        exit();
    } else {
        echo "<h3>Incorrect password!</h3>";
        echo "<p><a href='login.html'>Try again</a></p>";
    }
} else {
    echo "<h3>User not found! Please register first.</h3>";
    echo "<p><a href='register.html'>Register here</a></p>";
}

$conn->close();
?>
