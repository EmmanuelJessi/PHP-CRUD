<?php
session_start();
require 'dbcon.php';

if(isset($_SESSION['user_id'])) {
    header('Location: index.php');
    exit();
}

if(isset($_POST['register'])) {
    $username = $_POST['username'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    $query = "INSERT INTO users (username, password) VALUES ('$username', '$password')";
    $result = mysqli_query($con, $query);

    if($result) {
        header('Location: login.php');
        exit();
    } else {
        $error = "Registration failed. Please try again.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    
</head>
<body>
    <div class="login-form">
        <h2>Login</h2>
        <?php if(isset($error)): ?>
            <p><?= $error ?></p>
        <?php endif; ?>
        <form action="" method="POST">
            <label for="username">Username:</label><br>
            <input type="text" id="username" name="username" required><br>
            <label for="password">Password:</label><br>
            <input type="password" id="password" name="password" required><br>
            <input type="submit" name="login" value="Login">
            <!-- Use JavaScript to handle redirection -->
            <button type="button" onclick="redirectToRegisterPage()">Register</button>
        </form>
        <script>
            function redirectToRegisterPage() {
                window.location.href = 'register.php';
            }
        </script>
    </div>
</body>

</html>

