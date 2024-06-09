<?php
$host = 'localhost';
$user = 'root';
$password = '';
$database = 'db_hama';

$konek = mysqli_connect($host, $user, $password, $database);


if (mysqli_connect_errno()) {
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
    exit();
}
?>
