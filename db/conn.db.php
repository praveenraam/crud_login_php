<?php

$server = 'localhost';
$username = 'root';
$password = '';
$db_name = 'mydb';

$conn = mysqli_connect($server, $username, $password, $db_name);
if ($conn->connect_error) {
    die("Connection failed to db :" . $conn->connect_error);
}
