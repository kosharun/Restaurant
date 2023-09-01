<html>

<?php
require_once "../include/header.php";
require_once "../app/classes/Admin.php";
require_once "../app/classes/Product.php";

$admin = new Admin();
$new_product = new Product();
$products = $new_product->fetch_all();
$categories = $new_product->fetch_categories();

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $category = $_POST['category'];
    $products = $new_product->fetch_by_category($category);
}

?>

<style>

body {
    margin: 0;
    font-family: Roboto,-apple-system,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif,"Apple Color Emoji","Segoe UI Emoji","Segoe UI Symbol","Noto Color Emoji";
    font-weight: 400;
    line-height: 1.5385;
    color: #333;
    background-color: black;
}

.mt-50 {
    margin-top: 50px;
}

.mb-50 {
    margin-bottom: 50px;
}

.bg-teal-400 { 
    background-color: #26a69a;
}

a{
    text-decoration: none !important;
}

.fa {
        color: red;
}

.card-body {
    width: 100%;
    margin-bottom: 1%;
}
</style>

    <?php if($admin->is_logged()) : ?>

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
                            <div class="form-outline flex-fill mb-0">
                                <form action="" method="POST">
                                    <div class="d-flex flex-row align-items-center">
                                        <i class="fas fa-solid fa-list fa-lg me-3 fa-fw text-white"></i>
                                        <select class="col col-md-3 form-control bg-secondary text-white" style="width: 50%;" id="category" name="category">
                                            <option value="">Select a category</option>
                                            <?php foreach($categories as $category) : ?>
                                            <option value="<?php echo $category['name']; ?>"><?php echo $category['name']; ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                        <button type="submit" class="col-md-1 btn btn-warning">Go</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    <?php foreach($products as $product) : ?>
                    <div class="col-md-3 mb-4">
                    <div class="card card-body shadow" style="height: 72vh;">
                        <div class="media align-items-center align-items-lg-start text-center text-lg-left flex-column flex-lg-row">
                            
                            <div class="mr-2 mb-3 mb-lg-0">
                                    <img src="../public./product_images/<?php echo $product['image']; ?>" width="150" height="150" alt="">
                            </div>

                            <div class="media-body">
                                <h6 class="media-title font-weight-semibold">
                                    <h6 data-abc="true"><?php echo $product['name']; ?></h6>
                                </h6>

                                <ul class="list-inline list-inline-dotted mb-3 mb-lg-2">
                                    <li class="list-inline-item"><a href="#" class="text-muted" data-abc="true"><?php echo $product['category']; ?></a></li>
                                </ul>

                                <p class="mb-3"><?php echo $product['description']; ?></p>

                            </div>

                            <div class="mt-3 mt-lg-0 ml-lg-3 text-center">
                                <h3 class="mb-0 font-weight-semibold text-danger">$<?php echo $product['price']; ?></h3>

                                <div class="text-muted"><?php echo $product['size']; ?></div>

                                <a type="button" class="btn bg-warning border border-danger mt-4 text-white" href="delete_product.php?id=<?= $product['product_id']; ?>">Remove</a>
                                <a type="button" class="btn btn-primary mt-4 text-white" href="update_product.php?id=<?= $product['product_id']; ?>">Edit</a>
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
    <?php endif; ?>

</body>

</html>
