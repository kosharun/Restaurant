<html>
<?php 

require_once "../include/header.php";
require_once "../app/classes/Product.php";

$product_altering = new Product();
$_SESSION['latest_order_num'] = 98;
$product_id = $_GET['id'];
$product = $product_altering->read($product_id);

$categories = $product_altering->fetch_categories();

if($_SERVER['REQUEST_METHOD'] == "POST") {
    $name = $_POST['name'];
    $category = $_POST['category'];
    $description = $_POST['description'];
    $size = $_POST['size'];
    $price = $_POST['price'];
    $image = $_POST['image'];


    $product_altering->update($product_id, $name, $category, $description, $size, $price, $image);
    $_SESSION['message']['type'] = "success";
    $_SESSION['message']['text'] = "Successfully altered a product";
    header("location: index.php");

    exit();

}

?>

<link rel="stylesheet" href="https://unpkg.com/dropzone@5/dist/min/dropzone.min.css" type="text/css" />

    <section class="vh-100" style="background-color: black;">
        <div class="container h-100">
            <div class="row d-flex justify-content-center align-items-center h-100">
            <div class="col-lg-12 col-xl-11">
                <div class="card text-black" style="border-radius: 25px;">
                <div class="card-body p-md-5">
                    <div class="row justify-content-center">
                    <div class="col-md-10 col-lg-6 col-xl-5 order-2 order-lg-1">

                        <p class="text-center h1 fw-bold mb-5 mx-1 mx-md-4 mt-4">Edit Product</p>

                        <form class="mx-1 mx-md-4" action="" method="post">

                        <div class="d-flex flex-row align-items-center mb-4">
                            <i class="fas fa-solid fa-font fa-lg me-3 fa-fw"></i>
                            <div class="form-outline flex-fill mb-0">
                            <input type="text" id="form3Example1c" class="form-control" name="name" value="<?= $product['name'] ?>"/>
                            <label class="form-label" for="form3Example1c">Name</label>
                            </div>
                        </div>

                        <div class="d-flex flex-row align-items-center mb-4">
                            <i class="fas fa-solid fa-list fa-lg me-3 fa-fw"></i>
                            <div class="form-outline flex-fill mb-0">
                                <select class="col col-md-3 form-control bg-secondary text-white" id="category" name="category">
                                    <option value="">Select a category</option>
                                    <?php foreach($categories as $category) : ?>
                                    <option value="<?php echo $category['name']; ?>"><?php echo $category['name']; ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>

                        <div class="d-flex flex-row align-items-center mb-4">
                            <i class="fas fa-signature fa-lg me-3 fa-fw"></i>
                            <div class="form-outline flex-fill mb-0">
                            <input type="text" id="form3Example1c" class="form-control" maxlength="200" name="description" value="<?= $product['description'] ?>"/>
                            <label class="form-label" for="form3Example1c">Description (max 200 characters)</label>
                            </div>
                        </div>

                        <div class="d-flex flex-row align-items-center mb-4">
                            <i class="fas fa-expand fa-lg me-3 fa-fw"></i>
                            <div class="form-outline flex-fill mb-0">
                            <input type="text" id="form3Example4c" class="form-control" name="size" value="<?= $product['size'] ?>"/>
                            <label class="form-label" for="form3Example4c">Size</label>
                            </div>
                        </div>

                        <div class="d-flex flex-row align-items-center mb-4">
                            <i class="fas fa-money-bill-alt fa-lg me-3 fa-fw"></i>
                            <div class="form-outline flex-fill mb-0">
                            <input type="text" id="form3Example4c" class="form-control" name="price" value="<?= $product['price'] ?>"/>
                            <label class="form-label" for="form3Example4c">Price</label>
                            </div>
                        </div>

                        <div class="d-flex flex-row align-items-center mb-4">
                            <i class="fas fa-image fa-lg me-3 fa-fw"></i>
                            <div class="form-outline flex-fill mb-0">
                            <div class="mb-3">
                                <input type="hidden" name="image" id="photoPathInput" value="<?= $product['image'] ?>">
                                <div id="dropzone-upload" class="dropzone bg-dark text-white border rounded"></div>
                            </div>
                            <label class="form-label" for="photoPathInput">Image</label>
                            </div>
                        </div>

                        <div class="d-flex justify-content-center mx-4 mb-3 mb-lg-4">
                            <button type="submit" class="btn btn-warning btn-lg border-3 border-primary">Update Product</button>
                        </div>

                        </form>

                    </div>
                    </div>
                </div>
                </div>
            </div>
            </div>
        </div>
    </section>

    <script src="https://unpkg.com/dropzone@5/dist/min/dropzone.min.js"></script>

    <script>

        Dropzone.options.dropzoneUpload={
            url: "upload_photo.php",
            paramName: "photo",
            maxFilesize: 20, // MB
            acceptedFiles: "image/*",
            init: function () {
                this.on("success", function (file, response) { 
                    const jsonResponse = JSON.parse(response);
                    if (jsonResponse.success) {
                        document.getElementById('photoPathInput').value = jsonResponse.image;
                    } else { 
                        console.error(jsonResponse.error);
                    }
                });
            }
        };
        
    </script> 

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>