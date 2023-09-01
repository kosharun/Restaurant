<?php
require_once "../app/config/config.php";
require_once "../app/classes/Order.php";


$new_order = new Order();

$new_order->set_as_finished($_GET['order_id']);

$_SESSION['message']['type'] = "success";
$_SESSION['message']['text'] = "Successfully marked order as finished!";
header("location: orders.php");

exit();
?>