<?php

$serverName = "127.0.0.1";
$dBUsername = "root";
$dBPassword = "";
$dBName = "task_1";

$conn = mysqli_connect($serverName, $dBUsername, $dBPassword, $dBName);
$conn->set_charset("utf8mb4");
//tikriname ar duomenų bazė prijungta
if(!$conn) {
    die("Connection failed: " .mysqli_connect_error());

}