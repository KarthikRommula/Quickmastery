<?php
$sname = "localhost";
$uname = "root";
$password = "";
$db_name = "qm_login"; 
$conn = mysqli_connect($sname, $uname, $password, $db_name);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
} else {
    echo "Connected successfully";
}
?>
