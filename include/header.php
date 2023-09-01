<?php

require_once "../app/config/config.php";
require_once "../app/classes/Admin.php";
$admin = new Admin();
?>

<style>
    .nav-link {
        color: white;
    }
    .nav-link:hover {
        color: gray;
    }

</style>

<head>
    <title>At Harun's</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
    <meta charset="UTF-8">
    <!-- CSS BOOTSTRAP 5.3.1 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">

    <!-- ICONS BOOTSTRAP -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.2/font/bootstrap-icons.css" integrity="sha384-b6lVK+yci+bfDmaY1u0zE8YYJt0TZxLEAFyYSLHId4xoVvsrQu3INevFKo+Xir8e" crossorigin="anonymous">

    <!-- RESPONSIVE -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.bundle.min.js">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js">
</head>

<body style="padding: 1%;" class="bg-black">
    <!-- Navbar -->

    <nav class="navbar navbar-expand-lg navbar-light bg-dark border border-primary" style="margin-bottom: 5%; padding: 0.5%;">
    <button class="navbar-toggler border border-white" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon bg-white"></span>
    </button>

    <a class="navbar-brand text-warning" href="index.php">
        Harun's
    </a>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav ml-auto"> <!-- Use ml-auto to align items to the right -->
            <?php if ($admin->is_logged()) : ?>
                <li class="nav-item">
                    <a class="nav-link text-white" href="index.php">Products</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white" href="orders.php">Pending Orders</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white" href="../order.php">Ordering as customer</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white" href="../index.php">Order numbers list</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white" href="add_product.php"><i class="bi bi-plus"></i>Add New Product</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white" href="register.php">Register New Admin</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white" href="logout.php">Log Out</a>
                </li>
            <?php else: ?>
                <li class="nav-item">
                    <a class="nav-link text-white" href="login.php">Log In</a>
                </li>
            <?php endif; ?>
        </ul>
    </div>
</nav>



