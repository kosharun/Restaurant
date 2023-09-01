<?php 
    require_once "../app/classes/Admin.php";
    require_once "../app/config/config.php";
    $admin = new Admin();

    $admin->logout();
    header("location: login.php");
    exit();
?>