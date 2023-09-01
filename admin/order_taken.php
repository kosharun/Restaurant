<?php
require_once "../app/config/config.php";
require_once "../app/classes/Order.php";


$new_order = new Order();

$new_order->delete_order($_GET['order_id']);

$_SESSION['message']['type'] = "success";
$_SESSION['message']['text'] = "Successfully completed order!";
header("location: orders.php");

exit();
?>