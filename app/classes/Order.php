<?php
require_once "Cart.php";

class Order extends Cart {

    protected $conn;

    public function __construct() {
        global $conn;
        $this->conn = $conn;
    }

    public function create($order_number) {
        $run = $this->conn->prepare("INSERT INTO orders (order_number) VALUES (?)");
        $run->bind_param("i", $order_number);
        $run->execute();

        $order_id = $this->conn->insert_id;

        $cart_items = $this->read($order_number);

        $run = $this->conn->prepare("INSERT INTO order_items (order_id, product_id) VALUES (?, ?)");

        foreach ($cart_items as $item) {
            $run->bind_param("ii", $order_id, $item['product_id']);
            $run->execute();
        }
    }

    public function delete_order($order_id) {
        $run = $this->conn->prepare("DELETE FROM orders WHERE order_id = ?");
        $run->bind_param("i", $order_id);
        $run->execute();
    }

    public function fetch_all() {
        $run = $this->conn->prepare("SELECT * FROM orders");
        $run->execute();
        $results = $run->get_result();
        return $results->fetch_all(MYSQLI_ASSOC);
    }

    public function fetch_order_items($order_id) {
        $sql = "SELECT * FROM order_items WHERE order_id = ?";
    
        $run = $this->conn->prepare($sql);
        $run->bind_param("i", $order_id);
        $run->execute();
        $results = $run->get_result();
    
        return $results->fetch_all(MYSQLI_ASSOC);
    }

    public function set_as_finished($order_id) {
        $run = $this->conn->prepare("UPDATE orders SET is_finished = 1 WHERE order_id = ?");
        $run->bind_param("i", $order_id);
        $run->execute();
    }

}