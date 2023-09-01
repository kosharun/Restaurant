<?php

require_once "../app/classes/Product.php";
require_once "../app/config/config.php";

$product = new Product();
$product_id = $_GET['id'];

$product->delete($product_id);
header("location: index.php");
exit();

