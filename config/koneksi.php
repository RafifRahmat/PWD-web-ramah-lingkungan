<?php

$host = "localhost";
$username = "root";
$password = "";
$db = "cobapwd_1";

$conn =  new mysqli($host, $username, $password, $db);
 if ($conn->connect_error) {
    die("koneksi error" . $conn->connect_error);
 }