<?php

class Admin {

    protected $conn;

    public function __construct() {
        global $conn;
        $this->conn = $conn;
    }

    public function create($username, $password) {
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        $sql = "INSERT INTO admins (username, password) VALUES (?, ?)";

        $run = $this->conn->prepare($sql);
        $run->bind_param("ss", $username, $hashed_password);
        $result = $run->execute();

        if ($result){
            $_SESSION['admin_id'] = $run->insert_id;
            return true;
        }
        else {
            return false;
        }    
    }

    public function login($username, $password) {
        $sql = "SELECT admin_id, password FROM admins WHERE username = ? ";
    
        $run = $this->conn->prepare($sql);
        $run->bind_param("s", $username);
        $run->execute();
    
        $results = $run->get_result();

        if ($results->num_rows == 1) {
            $admin = $results->fetch_assoc();
    
            if (password_verify($password, $admin['password'])) {
                $_SESSION['admin_id'] = $admin['admin_id'];
                return true;
            }
        }

        return false;
    }
    
    public function logout() {
        if (isset($_SESSION['admin_id'])) {
            unset($_SESSION['admin_id']);
        }
    }

    public function is_logged() {
        if (isset($_SESSION['admin_id'])) {
            return true;
        } else {
            return false;
        }
    }
}

?>