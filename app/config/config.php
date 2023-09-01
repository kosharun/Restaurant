<?php

session_start();

$servername = "localhost";
$db_username = "root";
$db_password = "";
$database_name = "restaurant";

$conn = mysqli_connect($servername, $db_username, $db_password, $database_name);

if(!$conn){
    die("failed to connected");
}

if (!isset($_SESSION['latest_order_num'])) {
    $_SESSION['latest_order_num'] = 1;
}
