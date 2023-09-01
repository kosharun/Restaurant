<?php 

require_once "app/config/config.php";
require_once "app/classes/Order.php";



if ($_SESSION['latest_order_num'] < 99) {
    $_SESSION['latest_order_num'] += 1;
} else {
    $_SESSION['latest_order_num'] = 1;
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    echo($_POST['order_items'][0]);
    $order_number = $_GET['id'];
    $order = new Order();

    $order->create($order_number);

    $_SESSION['message']['type'] = "success";
    $_SESSION['message']['text'] = "Successfully ordered please wait for your order number!";
    header("location: order.php");
}
?>