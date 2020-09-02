<?php
include('_cus.function.php');
checksession();
getfoodlist();
if (isset($_POST['search'])) {
    searchAdd($_POST['address']);
}
if (isset($_POST['add'])) {
    if (blockAdd($_SESSION['cus_row']['address'])) {
        addCart($_POST['food_id']);
    }
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
    <link rel="stylesheet" href="./fontawesome-free-5.14.0-web/css/all.css">
    <link href="https://fonts.googleapis.com/css2?family=Baloo+Tammudu+2:wght@500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="./style/dashboard.css">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
    <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAjfNwSIkZCl8DtDcjKlhSq_CUZLEtteSg&libraries=places"></script>
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
                <li class="navbar-nav"><a href="acc_setting.php" class="nav-link"><?php echo $_SESSION['cus_row']['cus_name'] ?></a></li>
            </div>
            <div class="cart-btn" type="button" onclick='location.href="cart.php";'>
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
            <li class="nav-item help"><a href="help.php" class="nav-link">Help</a></li>
            <li class="nav-item order"><a href="order.php" class="nav-link">My Order</a></li>
            <li class="nav-item account"><a href="acc_setting.php" class="nav-link">Account Setting</a></li>
            <li class="nav-item logout"><a href="logout.php" class="nav-link">Logout</a></li>
            <hr>
            <li class="nav-item tel"><a href="tel:0388699498" class="nav-link">Contact Us</a></li>
            <li class="nav-item term"><a href="term.php" class="nav-link">Terms and Condition</a></li>
        </ul>
    </div>
</div>

<!-- Blook Content -->
<div class="modal fade" id="blockAdd" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header" style="display: block !important;">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">My Restaurant</h4>
            </div>
            <div class="modal-body">
                <p style="padding: 20px 30px;">Please enter food delivery address before get your order.</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<br>

<!-- Search Bar -->
<form action="dashboard.php" method="post">
    <div class="search input-group">
        <input type="text" name="address" id="address" class="form-control" value="<?php if(!empty($_GET['address'])) {echo $_GET['address'];} ?>" placeholder="Enter your delivery address">
        <div class="input-group-append">
            <button class="btn btn-outline-secondary" type="submit" name="search">Order Now</button>
        </div>
    </div>
    <span id="search_span" style="padding-left: 30px; line-height: 50px; font-size: 16px; color: rosybrown;"></span>
</form>

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
            <?php echo $directory; ?>
        </ul>
    </div>
</nav>

<br><hr>

<!-- products -->
<div class="container-fluid products">
    <?php echo $food_result; ?>
<br>

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

<!-- javascript go here -->
<script>
    const queryString = window.location.search;
    const urlParams = new URLSearchParams(queryString);
    const add = urlParams.get("add");
    if (add === "block") {
        $('#blockAdd').modal('show');
    } else if (add === 'undefinedcity') {
        search_span = document.getElementById('search_span');
        search_span.innerHTML = 'The address is undefined. Please ensure the CITY is inserted.';
    } else if (add === 'undefinedpostcode') {
        search_span = document.getElementById('search_span');
        search_span.innerHTML = 'The address is undefined. Please ensure the POSTCODE is inserted.';
    } else if (add === 'undeliverablepostcode') {
        search_span = document.getElementById('search_span');
        search_span.innerHTML = 'The address is undeliverable. We will improve our service to all areas as soon as possible.';
    }

    function init() {
        var input = document.getElementById('address');
        var autocomplete = new google.maps.places.Autocomplete(input);
    }
    google.maps.event.addDomListener(window, 'load', init);
</script>
</html>