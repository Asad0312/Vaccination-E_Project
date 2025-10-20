<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link rel="stylesheet" href="./css/register.css">
</head>

<body>
    <div class="register-container">
    <h2>Register</h2>
    <form action="" method="post">
        <input type="text" name="txtname" placeholder="Enter Your Name" required><br><br>
        <input type="email" name="txtemail" placeholder="Enter Your Email" required><br><br>
        <input type="text" name="txtuser" placeholder="Enter Your Username" required><br><br>
        <input type="Password" name="txtpass" placeholder="Enter Your Password" required><br><br>
        <input type="submit" name="btn">
    </form>
    </div>

    <?php
    include "dbConnection.php";

    if (isset($_POST["btn"])) {
        $name = $_POST["txtname"];
        $email = $_POST["txtemail"];
        $username = $_POST["txtuser"];
        $password = $_POST["txtpass"];

        $query = "INSERT INTO `user_pat`(`Name`, `Email`, `Username`, `passward`) VALUES (
            '$name','$email','$username','$password')";
        $result = mysqli_query($conn, $query);

        if ($result) {
            echo "Connection is ok";
            header("location:login.php");
        }
        else {
            echo "Not Connected";
        }
    }

    ?>

</body>

</html>