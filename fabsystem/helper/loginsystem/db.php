<?php

$dbhost = 'localhost';
$user = 'root';
$password = '';
$dbname = 'fabsystem';

$conn = mysqli_connect($dbhost, $user, $password, $dbname) or die($conn->error);
