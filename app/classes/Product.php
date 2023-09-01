<?php

class Product {

    protected $conn;

    public function __construct() {
        global $conn;
        $this->conn = $conn;
    }

    public function create($name, $category, $description, $size, $price, $image) {
        $sql = "INSERT INTO products (name, category, description, size, price, image) VALUES (?, ?, ?, ?, ?, ?)";
        $run = $this->conn->prepare($sql);
        $run->bind_param("ssssss", $name, $category, $description, $size, $price, $image);
        $run->execute();
    }

    public function read($product_id) {
        $sql = "SELECT * FROM products WHERE product_id = ?";
        $run = $this->conn->prepare($sql);
        $run->bind_param("i", $product_id);
        $run->execute();

        $result = $run->get_result();
        return $result->fetch_assoc();
    }

    public function update($product_id, $name, $category, $description, $size, $price, $image) {
        $sql = "UPDATE products SET name = ?, category = ?, description = ?, size = ?, price = ?, image = ? WHERE product_id = ?";
        $run = $this->conn->prepare($sql);
        $run->bind_param("ssssssi", $name, $category, $description, $size, $price, $image, $product_id);
        $run->execute();
    }

    public function delete($product_id) {
        $sql = "DELETE FROM products WHERE product_id = ?";
        $run = $this->conn->prepare($sql);
        $run->bind_param("i", $product_id);
        $run->execute();
    }

    public function fetch_all() {
        $sql = "SELECT * FROM products";
        $result = $this->conn->query($sql);

        $result = $result->fetch_all(MYSQLI_ASSOC);
        return $result;
    }

    public function add_to_cart($order_number, $product_id) {
        $sql = "INSERT INTO cart (order_number, product_id) VALUES (?, ?)";
        $run = $this->conn->prepare($sql);
        $run->bind_param("ii", $order_number, $product_id);
        $run->execute();
    }

    public function fetch_categories() {
        $sql = "SELECT name FROM categories";
        $result = $this->conn->query($sql);

        $result = $result->fetch_all(MYSQLI_ASSOC);
        return $result;
    }

    public function fetch_by_category($category) {
        $sql = "SELECT * FROM products WHERE category = ?";
        $run = $this->conn->prepare($sql);
        $run->bind_param("s", $category);
        $run->execute();
        $result = $run->get_result();

        $result = $result->fetch_all(MYSQLI_ASSOC);
        return $result;
    }
}