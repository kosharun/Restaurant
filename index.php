<?php
require_once "app/config/config.php";
require_once "app/classes/Order.php";
require_once "app/classes/Product.php";


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
    color: #333;
    padding: 1%;
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


<?php require_once "nav.css";?>


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
<body class="bg-black text-white">
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


    <div class="container mt-50 mb-50">      
        <div class="row justify-content-center">
            <div class="status-line">
                <div class="status-square status-green"></div>
                <span>Ready</span>
            </div>

            <div class="status-line">
                <div class="status-square status-orange"></div>
                <span>In Making</span>
            </div>

                <?php foreach($orders as $order) : $order_items = $new_order->fetch_order_items($order['order_id']); ?>
                <div class="col-md-3 mb-4 mt-3">
                <div class="card card-body border border-white shadow <?php if($order['is_finished'] == 1) {echo "bg-success";} else {echo "bg-warning";} ?>" >
                    <div class="media align-items-center align-items-lg-start text-center text-lg-left flex-column flex-lg-row">
                            <h6 class="media-title font-weight-semibold">
                                <h2 data-abc="true" class="text-white"><?php echo $order['order_number']; ?></h2>
                            </h6>
                        <?php if($order['is_finished'] == 0) : ?>
                            <p class="bg-secondary p-1">In Making</p>
                        <?php else : ?>
                            <p class="bg-secondary p-1">Ready</p>
                        <?php endif; ?>
                    </div>
                </div>   
                </div>       
                <?php endforeach; ?>
                            
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <?php require_once "redirect.html"; ?>

</body>