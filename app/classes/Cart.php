<?php

class Cart {

    protected $conn;

    public function __construct() {
        global $conn;
        $this->conn = $conn;
    }

    public function read($order_number) {
        $sql = "SELECT * FROM cart WHERE order_number = ?";
        $run = $this->conn->prepare($sql);
        $run->bind_param("i", $order_number);
        $run->execute();

        $result = $run->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    

}