<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
</head>
<body>
    <h2>Login Form</h2>
    <form method="post">
        <input type="text" name="username" placeholder="Enter Username" required><br><br>
        <input type="password" name="password" placeholder="Enter Password" required><br><br>
        <input type="submit" name="login" value="Login">
    </form>

    <?php
    session_start();
    include "dbConnection.php";

    if (isset($_POST['login'])) {
        $username = $_POST['username'];
        $password = $_POST['password'];

        $query = "SELECT * FROM `user_pat` WHERE username='$username'";
        $result = mysqli_query($conn, $query);
        $row = mysqli_fetch_assoc($result);

        if ($row && password_verify($password, $row['password'])) {
            $_SESSION['username'] = $username;
            header("Location: index.php"); // ✅ Redirect to home page
            exit();
        } else {
            echo "Invalid username or password!";
        }
    }
    ?>
</body>
</html>
