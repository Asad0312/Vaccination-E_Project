<?php
session_start();
include "dbConnection.php"; // ensure this sets $conn

$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['login'])) {
    $username = trim($_POST['username'] ?? '');
    $password = $_POST['password'] ?? '';
    $role = $_POST['role'] ?? '';

    if ($username === '' || $password === '' || $role === '') {
        $error = "Please fill all fields.";
    } else {
        // prepared statement
        $stmt = mysqli_prepare($conn, "SELECT id, username, passward, role FROM user_pat WHERE username = ? AND role = ? LIMIT 1");
        mysqli_stmt_bind_param($stmt, "ss", $username, $role);
        mysqli_stmt_execute($stmt);
        $res = mysqli_stmt_get_result($stmt);

        if ($res && $row = mysqli_fetch_assoc($res)) {
            $dbPassword = $row['passward']; // your DB column (maybe 'password' in your DB)
            $dbRole = $row['role'];

            $passwordOk = false;
            if (password_verify($password, $dbPassword)) {
                $passwordOk = true;
            } elseif ($password === $dbPassword) { // fallback if stored as plain text (not recommended)
                $passwordOk = true;
            }

            if ($passwordOk) {
                // login success
                $_SESSION['userid'] = $row['id'];
                $_SESSION['username'] = $row['username'];
                $_SESSION['role'] = $dbRole;

                // redirect based on role
                if ($dbRole === 'admin') {
                    header("Location: Admin/dashboard.php");
                    exit();
                } elseif ($dbRole === 'hospital') {
                    header("Location: Hospital/index.php");
                    exit();
                } else {
                    header("Location: index.php");
                    exit();
                }
            } else {
                $error = "Invalid username or password.";
            }
        } else {
            $error = "No account found for that username and role.";
        }

        mysqli_stmt_close($stmt);
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login | Health Center</title>
    <link rel="stylesheet" href="./css/login.css">
    <style>.error{ color:#b00020; text-align:center; margin-top:12px; }</style>
</head>
<body>
    <div class="login-container">
        <h2>Login</h2>
        <?php if ($error): ?>
            <p class="error"><?php echo htmlspecialchars($error); ?></p>
        <?php endif; ?>
        <form method="post" autocomplete="off">
            <input type="text" name="username" placeholder="Enter Username" required>
            <input type="password" name="password" placeholder="Enter Password" required>

            <select name="role" required>
                <option value="">-- Select Account Type --</option>
                <option value="admin">Admin</option>
                <option value="hospital">Hospital</option>
                <option value="patient">Patient</option>
            </select>

            <input type="submit" name="login" value="Login"><br><br>
            <a href="./Register.php">Register</a>
        </form>
    </div>
</body>
</html>
