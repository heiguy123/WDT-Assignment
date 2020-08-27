<?php
include_once('_cus.function.php');
checksession();
if (isset($_GET['logout'])) {
    logout();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Restaurant | Dashboard</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <!-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous"> -->
    <!-- <link rel="stylesheet" href="./fontawesome-free-5.14.0-web/css/all.css"> -->
    <link href="https://fonts.googleapis.com/css2?family=Baloo+Tammudu+2:wght@500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="./style/dashboard.css">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
</head>

<body>
<!-- navbar -->
<nav class="navbar navbar-light bg-light sticky-top">
    <div class="container-fluid">
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#hamburger" aria-controls="navbarToggleExternalContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
        </button>
        <a class="navbar-brand" href="#"><img src="img/res_logo.png" height=35>My Restaurant</a>
        <div>
            <div class="nav-nav">
                <li class="navbar-nav"><a href="#" class="nav-link">Username</a></li>
            </div>
            <div class="cart-btn" type="button" data-toggle="collapse" data-target="#cart">
                <span class="nav-icon"><i class="fas fa-cart-plus"></i></span>
                <div class="cart-items"><span>0</span></div>
            </div>
        </div>
    </div>
</nav>
<div class="collapse" id="hamburger">
    <div class="bg-white p-2">
        <ul class="navbar-nav">
            <li class="nav-item"><a href="#" class="nav-link">Home</a></li>
            <li class="nav-item"><a href="#" class="nav-link">Help</a></li>
            <li class="nav-item"><a href="#" class="nav-link">My Order</a></li>
            <li class="nav-item"><a href="#" class="nav-link">Account Setting</a></li>
            <li class="nav-item"><a href="?logout=1" class="nav-link">Logout</a></li>
            <hr>
            <li class="nav-item"><a href="#" class="nav-link">Contact Us</a></li>
            <li class="nav-item"><a href="#" class="nav-link">Terms and Condition</a></li>
        </ul>
    </div>
</div>
<div class="collapse" id="cart">
    <div class="p-4 row">
        <div class="jumbotron">
            <h5>Shopping Cart</h5>
            <hr>
            <div class="panel-body">
                <div class="row">
                    <div class="col-8">K1. Kolok Mee</div>
                    <div class="col-4">MYR 6.00</div>
                </div>
                <h5>Small</h5>
                <div class="row">
                    <div class="col-8">
                        <h5>+ Beam</h5>
                        <h5>+ Rice</h5>
                    </div>
                    <div class="col-4">
                        <input type="number">
                    </div>
                </div>
            </div>
        </div> 
        <div class="jumbotron">
            <h5>Shopping Cart</h5>
            <hr>
            <div class="panel-body">
                <div class="row">
                    <div class="col-8">K1. Kolok Mee</div>
                    <div class="col-4">MYR 6.00</div>
                </div>
                <h5>Small</h5>
                <div class="row">
                    <div class="col-8">
                        <h5>+ Beam</h5>
                        <h5>+ Rice</h5>
                    </div>
                    <div class="col-4">
                        <input type="number">
                    </div>
                </div>
            </div>
        </div>
               <!-- <div class="row">
                    <div class="col-xs-8">
                        <div class="panel panel-info">
                            <div class="panel-heading">
                                <div class="panel-title">
                                    <div class="row">
                                        <div class="col-xs-6">
                                            <h5><span class="glyphicon glyphicon-shopping-cart"></span> Shopping Cart</h5>
                                        </div>
                                        <div class="col-xs-6">
                                            <button type="button" class="btn btn-primary btn-sm btn-block">
                                                <span class="glyphicon glyphicon-share-alt"></span> Continue shopping
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                             <div class="panel-body">
                                <div class="row">
                                    <div class="col-xs-2"><img class="img-responsive" src="http://placehold.it/100x70">
                                    </div>
                                    <div class="col-xs-4">
                                        <h4 class="product-name"><strong>Product name</strong></h4><h4><small>Product description</small></h4>
                                    </div>
                                    <div class="col-xs-6">
                                        <div class="col-xs-6 text-right">
                                            <h6><strong>25.00 <span class="text-muted">x</span></strong></h6>
                                        </div>
                                        <div class="col-xs-4">
                                            <input type="text" class="form-control input-sm" value="1">
                                        </div>
                                        <div class="col-xs-2">
                                            <button type="button" class="btn btn-link btn-xs">
                                                <span class="glyphicon glyphicon-trash"> </span>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div> -->
            



            <!-- <h1 class="display-4"><em>You ordered My Restaurant</em></h1>
            <p class="lead">There are links on this page on GitHub and Blogspot.</p>
            <hr class="my-4">
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                Press <strong>button</strong> below to show links in Modal window.
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">×</span>
                </button>
            </div>
            <p class="lead">
            Button trigger modal
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalCenter">
            Show Modal Component with Links
            </button>
            </p>
            Modal
            <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLongTitle">Modal Component title</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <a href="https://sergeiki.github.io/bs0/" class="badge badge-danger">Visit this Bootstrap 4 Examples page on GitHub</a>
                            <a href="http://sergeiki.blogspot.com/2017/12/bootstrap-v4-layout-content-components-utilities-examples.html" class="badge badge-warning">Visit this Bootstrap 4 Examples blog on Blogspot</a>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-primary">Save changes</button>
                        </div>
                    </div>
                </div>
            </div> -->
        </div>
    </div>
</div>

<!-- <nav class="navbar navbar-expand navbar-light bg-light sticky-top">
    <div class="container-fluid">
        <span class="nav-icon"><i class="fas fa-bars"></i></span>
        <a class="navbar-brand" href="#"><img src="img/res_logo.png" height=50>My Restaurant</a>
        <div>
            <div class="nav-nav">
                <li class="navbar-nav"><a href="#" class="nav-link">Username</a></li>
            </div>
            <div class="cart-btn">
                <span class="nav-icon"><i class="fas fa-cart-plus"></i></span>
                <div class="cart-items">0</div>
            </div>
        </div>
    </div>
</nav> -->

<!-- alert box for success login -->
<div class="container-fluid" id="main-content">
    <div class="container" id="login-box">
        <div class="alert alert-success" role="alert" id="login-alert">
            Successfully logged in as <b><?php echo $_SESSION['cus_row']['cus_name'] ?></b>!
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    </div>
</div>

<!-- alert box for entering delivery address -->
<div class="container-fluid" id="main-content">
    <div class="container" id="input-box">
        <div class="alert alert-success" role="alert" id="input-alert">
            Please enter the delivery address before adding item into cart!
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    </div>
</div>

<!-- Flexbox container for aligning the toasts -->
<div aria-live="polite" aria-atomic="true" class="flexbox d-flex justify-content-center align-items-center" style="min-height: 200px;">
    <!-- Then put toasts within -->
    <div class="toast" role="alert" aria-live="assertive" aria-atomic="true">
        <div class="toast-header">
            <img src="./img/res_logo.png" class="rounded mr-2" wdith="10px">
            <strong class="mr-auto">My Restaurant</strong>
            <small>Warning</small>
            <button type="button" class="ml-2 mb-1 close" data-dismiss="toast" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="toast-body">
            Please enter the delivery address before adding item into cart!
        </div>
    </div>
</div>

<br>

<!-- Search Bar -->
<div class="search input-group">
    <input type="text" class="form-control" placeholder="Enter your delivery address">
    <div class="input-group-append">
        <button class="btn btn-outline-secondary" type="button">Order Now</button>
    </div>
</div>

<br>

<!--- Image Slider -->
<div class="carousel slide" id="slides" data-ride="carousel">
	<div class="carousel-inner">
		<div class="carousel-item active">
            <div class="row">
                <div class="col-3"><img src="img/noodle/蒜香虾油意面.jpg"></div>
                <div class="col-3"><img src="img/noodle/咖喱肥牛乌冬面.jpg"></div>
                <div class="col-3"><img src="img/noodle/岐山臊子面.jpg"></div>
                <div class="col-3"><img src="img/noodle/炒面.jpg"></div>
            </div>
        </div>
        <div class="carousel-item">
            <div class="row">
                <div class="col-3"><img src="img/noodle/牛肉炒粿条.jpg"></div>
                <div class="col-3"><img src="img/economic/糖醋排骨.jpg"></div>
                <div class="col-3"><img src="img/noodle/岐山臊子面.jpg"></div>
                <div class="col-3"><img src="img/noodle/红烧牛肉面.jpg"></div>
            </div>
        </div>
	</div>

	<a class="carousel-control-prev" href="#slides" role="button" data-slide="prev">
		<span class="carousel-control-prev-icon" aria-hidden="true"></span>
		<span class="sr-only">Previous</span>
	</a>
	<a class="carousel-control-next" href="#slides" role="button" data-slide="next">
		<span class="carousel-control-next-icon" aria-hidden="true"></span>
		<span class="sr-only">Next</span>
	</a>
</div>

<br>

<!-- Directory -->
<nav class="directory navbar navbar-expand">
    <div class="container-fluid">
        <h2>Category</h2>
        <ul class="navbar-nav">
            <li class="nav-item">
                <a href="#1" class="nav-link active">Noodles</a>
            </li>
            <span> | </span>
            <li class="nav-item">
                <a href="#" class="nav-link">Rice</a>
            </li>
            <span> | </span>
            <li class="nav-item">
                <a href="#1" class="nav-link">Soup</a>
            </li>
            <span> | </span>
            <li class="nav-item">
                <a href="#" class="nav-link">Drink and Beverage</a>
            </li>
        </ul>
    </div>
</nav>

<br><hr>

<!-- products -->
<div class="container-fluid products">
    <br>
    <!-- Section -->
    <div class="section-title">
            <h2>Noodle</h2>
    </div>

    <!-- products -->
    <div class="row padding" id="card">
        <!-- single product -->
        <div class="products-center col-2">
            <div class="card" data-toggle="modal" data-target="#pic1">
                <img class="card-img-top product-image" src="img/noodle/蒜香虾油意面.jpg">
                <div class="card-body">
                    <h6 class="card-title col-12">K1. Curry Beef Udon</h6>
                    <div class="row">
                        <p class="card-text product-price col-8">Start from RM10.50</p>
                        <span class="btn col-1"><i class="fas fa-plus-square"></i></span>
                    </div>
                </div>
            </div>
        </div>  
    </div>

    <br>
    <!-- Section -->
    <div class="section-title">
            <h2>Rice</h2>
    </div>

    <!-- products -->
    <div class="row padding" id="card">
        <!-- single product -->
        <div class="products-center col-2">
            <div class="card" data-toggle="modal" data-target="#pic1">
                <img class="card-img-top product-image" src="img/noodle/蒜香虾油意面.jpg">
                <div class="card-body">
                    <h6 class="card-title col-12">K1. Curry Beef Udon</h6>
                    <div class="row">
                        <p class="card-text product-price col-8">Start from RM10.50</p>
                        <span class="btn col-1"><i class="fas fa-plus-square"></i></span>
                    </div>
                </div>
            </div>
        </div>  
    </div>

    <br>
    <!-- Section -->
    <div class="section-title">
            <h2>Soup</h2>
    </div>

    <!-- products -->
    <div class="row padding" id="card">
        <!-- single product -->
        <div class="products-center col-2">
            <div class="card" data-toggle="modal" data-target="#pic1">
                <img class="card-img-top product-image" src="img/noodle/蒜香虾油意面.jpg">
                <div class="card-body">
                    <h6 class="card-title col-12">K1. Curry Beef Udon</h6>
                    <div class="row">
                        <p class="card-text product-price col-8">Start from RM10.50</p>
                        <span class="btn col-1"><i class="fas fa-plus-square"></i></span>
                    </div>
                </div>
            </div>
        </div>  
    </div>

    <br>
    <!-- Section -->
    <div class="section-title">
        <h2>Drink and Beverages</h2>
    </div>

    <!-- products -->
    <div class="row padding" id="card">
        <!-- single product -->
        <div class="products-center col-2">
            <div class="card" data-toggle="modal" data-target="#pic1">
                <div class="card-body">
                    <h6 class="card-title col-12">K1. Curry Beef Udon</h6>
                    <div class="row">
                        <p class="card-text product-price col-8">Start from RM10.50</p>
                        <span class="btn col-1"><i class="fas fa-plus-square"></i></span>
                    </div>
                </div>
            </div>
        </div> 
    </div>
</div>

<!-- cart -->
<div class="cart-overlay">
    <div class="cart">
        <span class="close-cart">
            <i class="fas fa-window-close"></i>
        </span>
        <h2>You ordered My Restaurant</h2>
        <div class="cart-content">
            <div class="cart-item">
                <img src="./img/noodle/蒜香虾油意面.jpg">
                <div>
                    <h4>K1. Curry Beef Udon</h4>
                    <h5>MYR 10.50</h5>
                    <span class="remove-item" data-id=1>remove</span>
                </div>
                <div>
                    <i class="fas fa-chevron-up" data-id=1></i>
                    <p class="item-amount">1</p>
                    <i class="fas fa-chevron-down" data-id=1></i>
                </div>
            </div>
            
        </div>

        <div class="cart-footer">
            <h3>subtotal : MYR <span class="cart-total">0</span></h3>
            <h3>Delivery Fee : MYR <span class="cart-total">0</span></h3>
            <h3>Including Service Tax : MYR <span class="cart-total">0</span></h3>
            <h3>Total (Incl. Service Tax) : MYR <span class="cart-total">0</span></h3>
            <button class="clear-cart banner-btn">clear cart</button>
            <button class="checkout banner-btn">Checkout</button>
        </div>
    </div>
</div>

<br>

<!--- Footer -->
<footer>
    <div class="container-fluid padding">
        <div class="row text-center">
            <div class="col-4">
                <a id="logo_a" href="index.php"><img src="img/res_logo_invert.png" width="65">My Restaurant</a>
                <hr>
                <a href="tel:0388699498">03-8869 9498</a><br><br>
                <a href="mailto:myrestaurant@gmail.com">myrestaurant@gmail.com</a><br><br>
                <p>100 Bukit Jalil</p>
                <p>Kuala Lumpur, Kuala Lumpur, 57000</p>
            </div>

            <div class="col-4">
                <hr>
                <h5>Our Hours</h5>
                <hr>
                <p>Monday: 9am - 5pm</p>
                <p>Saturday: 10am - 4pm</p>
                <p>Sunday: closed</p>
            </div>

            <div class="col-4">
                <hr>
                <h5>Service Area</h5>
                <hr>
                <p>Kuala Lumpur</p>
                <p>Shah Alam</p>
                <p>Subang Jaya</p>
                <p>Batu Caves</p>
            </div>
         
            <div class="col-12">
                <hr>
                <a href="term.php">&copy; myrestaurant.com</a>
            </div>
        </div>    
    </div>
</footer>

<!-- javascript go here -->
<script>
    // this is to get the parameter using javascript
    const queryString = window.location.search;

    const urlParams = new URLSearchParams(queryString);

    const welcome = urlParams.get('welcome');

    //only alert when the user is logged in through login page
    $(document).ready(function() {
        if (welcome === "welcome") {
            showAlert(1);
        }
    });

    function showAlert(type) {
        if (type == 0) {
            $("#login-box").fadeTo(2000, 500).slideUp(500, function() {
                $("#login-box").slideUp(500);
            });
        } else if (type == 1) {
            document.getElementById('main-content').style.background = 'rgba(0,0,0,0.5)';
            $("#input-box").fadeTo(2000, 500).slideUp(500, function() {
                $("#input-box").slideUp(500);
            });
        }
    }
</script>
</body>
</html>