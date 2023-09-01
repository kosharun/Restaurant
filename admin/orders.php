<?php
require_once "../include/header.php";
require_once "../app/classes/Order.php";
require_once "../app/classes/Product.php";


$new_product = new Product();
$new_order = new Order();

$orders = $new_order->fetch_all();
?>

<style>

body {
    margin: 0;
    font-family: Roboto,-apple-system,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif,"Apple Color Emoji","Segoe UI Emoji","Segoe UI Symbol","Noto Color Emoji";
    font-weight: 400;
    line-height: 1.5385;
    color: white;
    background-color: black;

}

a{
    text-decoration: none !important;
}

.card-body {
    width: 100%;
    margin-bottom: 1%;
}
.status-line {
    display: flex;
    align-items: center;
}

.status-square {
    width: 20px;
    height: 20px;
    margin-right: 10px;
    border-radius: 4px;
}

.status-green {
    background-color: green;
}

.status-orange {
    background-color: orange;
}
</style>

<body>
    <div class="container">
        <?php if(isset($_SESSION['message'])) : ?>
            <div class="alert alert-<?php echo $_SESSION['message']['type']; ?> alert-dismissible fade show" role="alert">
                <?php
                echo $_SESSION['message']['text'];
                unset($_SESSION['message']);
                ?>
            </div>
        <?php endif; ?>
        <?php
            $admin = new Admin(); 
            if ($admin->is_logged()){
                
            }
            else {

            }
        ?>
    </div>

    
    <div class="container mt-50 mb-50">      
        <div class="row justify-content-center">
            <div class="status-line">
                <div class="status-square status-green"></div>
                <span>Finished</span>
            </div>

            <div class="status-line">
                <div class="status-square status-orange"></div>
                <span>Pending</span>
            </div>
                <?php foreach($orders as $order) : $order_items = $new_order->fetch_order_items($order['order_id']); ?>
                <div class="col-md-3 mb-4">
                <br></br>
                <div class="card card-body shadow border border-white <?php if($order['is_finished'] == 1) {echo "bg-success";} else {echo "bg-warning";} ?>" >
                    <div class="media align-items-center align-items-lg-start text-center text-lg-left flex-column flex-lg-row">
                            <h6 class="media-title font-weight-semibold">
                                <h6 class="p-1 bg-black rounded" data-abc="true"><?php echo $order['order_number']; ?></h6>
                            </h6>
                            <?php foreach($order_items as $item) : 
                                $product = $new_product->read($item['product_id']);
                            ?>
                        <div class="card card-body shadow">
                            <p class="mb-3 text-danger"><?php echo $product['name']; ?></p>
                            <p class="text-muted" data-abc="true"><?php echo $product['category']; ?></p>

                            <div class="mt-3 mt-lg-0 ml-lg-3 text-center">
                                <div class="text-muted"><?php echo $product['size']; ?></div>
                            </div>
                        </div>
                        <?php endforeach; ?>
                        <?php if($order['is_finished'] == 0) : ?>
                        <a type="button" class="btn btn-success border border-danger mt-4" href="finish_order.php?order_id=<?= $order['order_id']; ?>">Mark Order as Finished</a>
                        <?php else : ?>
                        <p class="border border-warning bg-secondary p-1">Finished</p>
                        <?php endif; ?>
                        <a type="button" class="btn btn-dark border border-danger mt-4" href="order_taken.php?order_id=<?= $order['order_id']; ?>">Remove Order</a>
                    </div>
                </div>   
                </div>       
                <?php endforeach; ?>
                            
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>