<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact</title>
</head>
<body>
    <form action="" method="post">
        <input type="text" placeholder="Enter your Name" name="name"><br><br>
        <input type="email" placeholder="Enter your Email" name="email"><br><br>
        <input type="number" placeholder="Enter your Phone Number" name="number"><br><br>
        <input type="text" placeholder="Enter your Address" name="address"><br><br>
        <h4>Your ID card</h4>
        <input type="file" name="card"><br><br>
        <input type="submit" name="btn" value="Contact Now"><br><br>
    </form>
    
    <?php
    include "./dbConnection.php";

    if(isset($_POST['btn'])){
        $name = $_POST['name'];
        $email = $_POST['email'];
        $number = $_POST['number'];
        $address = $_POST['address'];
        // $name = $_POST['name'];
        $query = "INSERT INTO `contact`(`Name`, `Email`, `Phone`, `Address`) VALUES ('$name','$email','$number','$address')";
        $result = mysqli_query($conn,$query);
        
    }


    ?>
    
</body>
</html>