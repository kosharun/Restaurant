<?php

require_once "app/classes/Product.php";
require_once "app/config/config.php";


$product = new Product();
$product_id = $_GET['id'];

$product->add_to_cart($_SESSION['latest_order_num'], $product_id);
header("location: order.php");
exit();

