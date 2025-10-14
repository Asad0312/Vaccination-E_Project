<?php
$conn = mysqli_connect("localhost","root","","vaccination");

if ($conn) {
    echo "Connected";
}
else {
    echo "Not connected";
}
?>