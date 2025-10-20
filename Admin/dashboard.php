<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Appointments Dashboard</title>
</head>
<body>

<h2>All Appointments</h2>

<table border="1" cellpadding="8" cellspacing="0">
    <tr>
        <th>ID</th>
        <th>Name</th>
        <th>Email</th>
        <th>Date</th>
        <th>Option</th>
        <th>Phone</th>
    </tr>

    <?php
    include "../dbConnection.php";

    $query = "SELECT * FROM `apointment` ";
    $resul = mysqli_query($conn,$query);

    foreach($resul as $row)
    {
        echo "<tr>";
            echo "<td>$row[ID]</td>";
            echo "<td>$row[Name]</td>";
            echo "<td>$row[Email]</td>";
            echo "<td>$row[Date]</td>";
            echo "<td>$row[Option]</td>";
            echo "<td>$row[Phone]</td>";
            

        echo "</tr>";
    }
    ?>
</table>

</body>
</html>
