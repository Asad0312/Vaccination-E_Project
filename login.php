<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login | Health Center</title>
    <link rel="stylesheet" href="./css/login.css">
</head>
<body>

    <div class="login-container">
        <h2>Login</h2>
        <form method="post">
            <input type="text" name="username" placeholder="Enter Username" required>
            <input type="password" name="password" placeholder="Enter Password" required>
            <input type="submit" name="login" value="Login"><br><br>
            <a href="./Register.php">Register</a>
        </form>
    </div>

    <?php
    session_start();
    include "dbConnection.php";

    if (isset($_POST['login'])) {
        $username = $_POST['username'];
        $password = $_POST['password'];

        $query = "SELECT * FROM `user_pat` WHERE username='$username'";
        $result = mysqli_query($conn, $query);

        if (mysqli_fetch_assoc($result)) {
            $_SESSION['username'] = $username;
            header("Location: index.php");
            exit();
        } else {
            echo "<p class='error'>Invalid username or password!</p>";
        }
    }
    ?>
</body>
</html>
