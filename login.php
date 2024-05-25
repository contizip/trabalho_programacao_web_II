<?php
session_start();
include 'db_config.php';
if ($_SERVER["REQUEST_METHOD"] == "POST") {
$email = $_POST['email'];
$password = $_POST['password'];
$sql = "SELECT * FROM users WHERE email = '$email' AND password =
'$password'";
$result = mysqli_query($conn, $sql);
if (mysqli_num_rows($result) > 0) {
$_SESSION['user'] = $email;
header("Location: dashboard.php");
} else {
echo "Invalid email or password.";
}
}
?>




<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>
    <form method="post" action="login.php">
        <label for="email">Email:</label>
        <input type="text" id="email" name="email" required>
        <label for="password">Senha:</label>
        <input type="password" id="password" name="password" required>
        <button type="submit">Login</button>
    </form>
</body>
</html>
