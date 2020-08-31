<?php
include_once('_cus.function.php');
checksession();
getcartdetail();
if (isset($_POST['update'])) {
    updateCart($_POST['cartdetail_id'],$_POST['food_quantity']);
}
if (isset($_POST['delete'])) {
    deleteCart($_POST['cartdetail_id']);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Restaurant | My Order</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <!-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous"> -->
    <link rel="stylesheet" href="./fontawesome-free-5.14.0-web/css/all.css">
    <link href="https://fonts.googleapis.com/css2?family=Baloo+Tammudu+2:wght@500&display=swap" rel="stylesheet">
    <!-- <link rel="stylesheet" href="./style/dashboard.css"> -->
    <!-- <link rel="stylesheet" href="./css/cart.css"> -->
    <link rel="stylesheet" href="./style/cart.css">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
</head>

<body>
<!-- navbar -->
<nav class="navbar navbar-light bg-light sticky-top">
    <div class="container-fluid">
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#hamburger" aria-controls="navbarToggleExternalContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
        </button>
        <a class="navbar-brand" href="dashboard.php"><img src="img/res_logo.png" height=35>My Restaurant</a>
        <div>
            <div class="nav-nav">
                <li class="navbar-nav"><a href="account.php" class="nav-link"><?php echo $_SESSION['cus_row']['cus_name'] ?></a></li>
            </div>
            <div class="cart-btn" type="button" data-toggle="collapse" data-target="#cart">
                <span class="nav-icon"><i class="fas fa-cart-plus"></i></span>
                <div class="cart-items"><span><?php echo numCart($_SESSION['cus_row']['cus_id']) ?></span></div>
            </div>
        </div>
    </div>
</nav>
<div class="collapse" id="hamburger">
    <div class="bg-white p-2">
        <ul class="navbar-nav">
            <li class="nav-item home"><a href="dashboard.php" class="nav-link">Home</a></li>
            <li class="nav-item help"><a href="#" class="nav-link">Help</a></li>
            <li class="nav-item order"><a href="#" class="nav-link">My Order</a></li>
            <li class="nav-item account"><a href="account.php" class="nav-link">Account Setting</a></li>
            <li class="nav-item logout"><a href="logout.php" class="nav-link">Logout</a></li>
            <hr>
            <li class="nav-item tel"><a href="tel:0388699498" class="nav-link">Contact Us</a></li>
            <li class="nav-item term"><a href="term.php" class="nav-link">Terms and Condition</a></li>
        </ul>
    </div>
</div>
<div class="collapse" id="cart">
    <div class="p-4 row">
        <div class="jumbotron">
            <h4>Shopping Cart</h4>
            <button class="btn btn-secondary-outline" type="button" onclick="location.href='cart.php';">More Details</button>
            <hr>
            <div class="panel-body row padding">
                <fieldset>
                    <img src="./img/noodle/蒜香虾油意面.jpg" style="max-height: 130px;">
                    <h4>Curry Beef Udon</h4>
                    <h6>MYR 10.50</h6>
                    <input type="number">
                </fieldset>
                <fieldset>
                    <img src="./img/noodle/蒜香虾油意面.jpg" style="max-height: 130px;">
                    <h4>Curry Beef Udon</h4>
                    <h6>MYR 10.50</h6>
                    <input type="number">
                </fieldset>
                <fieldset>
                    <img src="./img/noodle/蒜香虾油意面.jpg" style="max-height: 130px;">
                    <h4>Curry Beef Udon</h4>
                    <h6>MYR 10.50</h6>
                    <input type="number">
                </fieldset>
            </div>
        </div> 
    </div>
</div>

<div class="container">
   <div class="card shopping-cart">
        <div class="card-header bg-dark text-light">
            <i class="fa fa-shopping-cart" aria-hidden="true"></i>
            Shopping cart
            <a href="dashboard.php" class="btn btn-outline-info btn-sm text-right continue">Continue shopping</a>
            <div class="clearfix"></div>
        </div>
        <div class="card-body">
            <?php echo $cart_result; ?>
        </div>
        <div class="card-footer">
            <div class="pull-right" style="margin: 10px">
                <div class="pull-right" style="margin: 5px; width: 40%; margin-bottom: 18px;">
                    <div class="row padding">
                        <div class="text-left col-6">Subtotal: </div>
                        <div class="text-right col-3"><b>MYR </b></div>
                        <div class="text-left col-3"><b><?php echo $subtotal; ?></b></div><br>
                    </div>
                    <div class="row padding">
                        <div class="text-left col-6">Delivery Fee: </div>
                        <div class="text-right col-3"><b>MYR </b></div>
                        <div class="text-left col-3"><b><?php echo $delivery_fee; ?></b></div><br>
                    </div>
                    <div class="row padding">
                        <div class="text-left col-6">Including Service Tax: </div>
                        <div class="text-right col-3"><b>MYR </b></div>
                        <div class="text-left col-3"><b><?php echo $service_tax; ?></b></div><br>
                    </div>
                    <div class="row padding">
                        <div class="text-left col-6">Total (Incl. Service Tax): </div>
                        <div class="text-right col-3"><b>MYR </b></div>
                        <div class="text-left col-3"><b><?php echo $total; ?></b></div><br>
                    </div>
                </div>
                <a href="payment.php" class="btn btn-success pull-right">Checkout</a>
            </div>
        </div>
    </div>
</div>    


<br><br><br><br><br><br><br>
<br><br><br><br><br><br><br>

<!--- Footer -->
<footer>
    <div class="container-fluid padding">
        <div class="row text-center">
            <div class="col-12">
                <a href="term.php">&copy; myrestaurant.com</a>
            </div>
        </div>    
    </div>
</footer>
</body>
</html>