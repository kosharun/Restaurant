<html>

<?php
require_once "app/config/config.php";
require_once "app/classes/Product.php";
require_once "app/classes/Cart.php";


$product = new Product();

$products = $product->fetch_all();
$categories = $product->fetch_categories();

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $category = $_POST['category'];
    $products = $product->fetch_by_category($category);
}

$cart_items = new Cart();
$cart_items = $cart_items->read($_SESSION['latest_order_num']);

?>
<!DOCTYPE html>
<html>
<head>
    <title>Elite Shop</title>
    <!-- boostrap -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <!-- boostrap icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <style>
        /* Style for the cart container */
        .cart-container {
            position: fixed;
            top: 0;
            right: 0;
            background-color: orange;
            color: black;
            padding: 1%;
            border-radius: 0 0 0 5px;
            cursor: pointer;
            z-index: 4;
        }
        body {
            margin: 0;
            font-family: Roboto,-apple-system,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif,"Apple Color Emoji","Segoe UI Emoji","Segoe UI Symbol","Noto Color Emoji";
            font-weight: 400;
            line-height: 1.5385;
            color: #333;
        }
        .card-body {
            width: 100%;
            margin-bottom: 1%;
        }
        a{
            text-decoration: none !important;
        }
        @media (max-width: 768px) {
            .cart-toggle-button {
                position: fixed;
                left: 10px;
                background-color: rgb(0, 0, 0);
                padding: 1%;
                color: rgb(0, 0, 0);
                width: 25%;
                margin-top: 80%;
                color: white;
            }
        }
    <?php require_once "nav.css";?>

    </style>
</head>
<body class="bg-black" style="padding: 1%; color: white;">
<nav>
  <ul>
    <li id="home">
      <div class="home-icon">
        <div class="roof">
          <div class="roof-edge"></div>
        </div>
        <div class="front"></div>
      </div>
    </li>
    <li id="about">
      <div class="about-icon">
        <div class="head">
          <div class="eyes"></div>
          <div class="beard"></div>
        </div>
      </div>
    </li>
    <li id="work">
      <div class="work-icon">
        <div class="paper"></div>
        <div class="lines"></div>
        <div class="lines"></div>
        <div class="lines"></div>
      </div>
    </li>
  </ul>
</nav>


    <!-- Cart toggle button -->
    <div class="cart-toggle-button bg-dark p-1 border border-warning" style="position: fixed; top: 10px; right: 10px; cursor: pointer; z-index: 3;">
        <i class="bi bi-cart-fill" ></i> View Cart
    </div>

    <!-- Cart container -->
    <div class="cart-container border border-2 border-dark">
        <h5 class="bg-secondary p-1 text-center">Cart</h5>
        <form action="send_order.php?id=<?php echo $_SESSION['latest_order_num']; ?>" method="POST">
            <ul name="order_items">
                <?php foreach ($cart_items as $cart_item) : ?>
                    <?php 
                        $product_info = $product->read($cart_item['product_id']);  
                        $product_name = $product_info['name'];
                    ?>
                    <li><?php echo $product_name; ?></li>
                    <input type="hidden" name="order_items[]" value="<?php echo $product_name; ?>">
                <?php endforeach; ?>
                
                <!-- Cart items -->
            </ul>
            <div class="border border-dark p-1 bg-danger"><p class="text-center">Your order number:</p> <h4 class="text-center"><?= $_SESSION['latest_order_num']; ?></h4></div>
            <button type="submit" class="btn btn-dark border border-danger mt-4 text-white">Order</button>
            <button class="btn btn-secondary mt-4" id="hide-cart">Hide Cart</button>
        </form>
    </div>


    
    <div class="container">
        <?php if(isset($_SESSION['message'])) : ?>
            <div class="alert alert-<?php echo $_SESSION['message']['type']; ?> alert-dismissible fade show" role="alert">
                <?php
                echo $_SESSION['message']['text'];
                unset($_SESSION['message']);
                ?>
            </div>
        <?php endif; ?> 
    </div>
        <div class="container mt-50 mb-50">      
            <div class="row justify-content-center">
            <div class="d-flex flex-row align-items-center mb-4">
                <i class="fas fa-solid fa-list fa-lg me-3 fa-fw"></i>
                <div class="form-outline flex-fill mb-0">
                    <form action="" method="POST">
                        <div class="d-flex flex-row align-items-center">
                            <select class="col col-md-3 form-control bg-secondary text-white" style="width: 50%;" id="category" name="category">
                                <option value="">Select a category</option>
                                <?php foreach($categories as $category) : ?>
                                <option value="<?php echo $category['name']; ?>"><?php echo $category['name']; ?></option>
                                <?php endforeach; ?>
                            </select>
                            <button type="submit" class="col-md-1 btn btn-warning" s>Go</button>
                        </div>
                    </form>
                </div>
            </div>
                    <?php foreach($products as $product) : ?>
                    <div class="col-md-3 mb-4">
                    <div class="card card-body shadow" style="height: 72vh;">
                        <div class="media align-items-center align-items-lg-start text-center text-lg-left flex-column flex-lg-row">
                            
                            <div class="mr-2 mb-3 mb-lg-0">
                                    <img src="public./product_images/<?php echo $product['image']; ?>" width="150" height="150" alt="">
                            </div>

                            <div class="media-body">
                                <h6 class="media-title font-weight-semibold">
                                    <h6 data-abc="true" class="text-warning border bg-dark p-1"><?php echo $product['name']; ?></h6>
                                </h6>

                                <ul class="list-inline list-inline-dotted mb-3 mb-lg-2">
                                    <li class="list-inline-item"><a href="#" class="text-muted" data-abc="true"><?php echo $product['category']; ?></a></li>
                                </ul>

                                <p class="mb-3 text-dark"><?php echo $product['description']; ?></p>

                            </div>

                            <div class="mt-3 mt-lg-0 ml-lg-3 text-center">
                                <h3 class="mb-0 font-weight-semibold text-danger">$<?php echo $product['price']; ?></h3>

                                <div class="text-muted"><?php echo $product['size']; ?></div>

                                <a type="button" class="btn btn-warning border border-danger mt-4 text-white" href="add_to_cart.php?id=<?= $product['product_id']; ?>">Add to Order</a>
                            </div>
                        </div>
                    </div>   
                    </div>            
                    <?php endforeach; ?>
                                
            </div>
        </div>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script>
        $(document).ready(function() {
            // Toggle cart visibility when clicking on the cart toggle button
            $(".cart-toggle-button").click(function() {
                $(".cart-container").toggle();
            });

            // Hide the cart when clicking on the "Hide Cart" button
            $("#hide-cart").click(function() {
                event.preventDefault(); 
                $(".cart-container").hide();
            });
        });
    </script>
    <?php require_once "redirect.html";?>

</body>

</html>
