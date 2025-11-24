<?php
$connect = mysqli_connect(
    'localhost',
    'root',
    '',       // EMPTY PASSWORD for XAMPP Windows
    'parks'
);

if(!$connect){
    die('Connection Failed: ' . mysqli_connect_error());
}
?>
