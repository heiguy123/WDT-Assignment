<?php
include_once('_cus.function.php');
checksession();
getfoodlist();
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
    <link rel="stylesheet" href="./fontawesome-free-5.14.0-web/css/all.css">
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
        <a class="navbar-brand" href="dashboard.php"><img src="img/res_logo.png" height=35>My Restaurant</a>
        <div>
            <div class="nav-nav">
                <li class="navbar-nav"><a href="account.php" class="nav-link"><?php echo $_SESSION['cus_row']['cus_name'] ?></a></li>
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
            <li class="nav-item home"><a href="dashboard.php" class="nav-link">Home</a></li>
            <li class="nav-item help"><a href="#" class="nav-link">Help</a></li>
            <li class="nav-item order"><a href="#" class="nav-link">My Order</a></li>
            <li class="nav-item account"><a href="account.php" class="nav-link">Account Setting</a></li>
            <li class="nav-item logout"><a href="?logout=1" class="nav-link">Logout</a></li>
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
                <a href="#link1" class="nav-link active"><?php echo $category_name[0][1]; ?></a>
            </li>
            <span> | </span>
            <li class="nav-item">
                <a href="#link2" class="nav-link"><?php echo $category_name[1][2]; ?></a>
            </li>
            <span> | </span>
            <li class="nav-item">
                <a href="#link3" class="nav-link"><?php echo $category_name[2][3]; ?></a>
            </li>
        </ul>
    </div>
</nav>

<br><hr>

<!-- products -->
<div class="container-fluid products">
    <br>
    <!-- Section -->
    <a name="link1"></a>
    <div class="section-title">
        <h2><?php echo $category_name[0][1]; ?></h2>
    </div>

    <!-- products -->
    <div class="row padding" id="card">
        <!-- single product -->
        <div class="products-center col-2">
            <div class="card">
                <?php echo $food_list[0][4] ?>
                <div class="card-body">
                    <h6 class="card-title col-12"><?php echo $food_list[0][2] ?></h6>
                    <div class="row">
                        <p class="card-text product-price col-8">Start from RM<?php echo $food_list[0][3] ?></p>
                        <span class="btn col-1"><i class="fas fa-plus-square"></i></span>
                    </div>
                </div>
            </div>
        </div>

        <div class="products-center col-2">
            <div class="card">
                <?php echo $food_list[1][5] ?>
                <div class="card-body">
                    <h6 class="card-title col-12"><?php echo $food_list[1][3] ?></h6>
                    <div class="row">
                        <p class="card-text product-price col-8">Start from RM<?php echo $food_list[1][4] ?></p>
                        <span class="btn col-1"><i class="fas fa-plus-square"></i></span>
                    </div>
                </div>
            </div>
        </div>

        <div class="products-center col-2">
            <div class="card">
                <?php echo $food_list[2][6] ?>
                <div class="card-body">
                    <h6 class="card-title col-12"><?php echo $food_list[2][4] ?></h6>
                    <div class="row">
                        <p class="card-text product-price col-8">Start from RM<?php echo $food_list[2][5] ?></p>
                        <span class="btn col-1"><i class="fas fa-plus-square"></i></span>
                    </div>
                </div>
            </div>
        </div>

        <div class="products-center col-2">
            <div class="card">
                <?php echo $food_list[3][7] ?>
                <div class="card-body">
                    <h6 class="card-title col-12"><?php echo $food_list[3][5] ?></h6>
                    <div class="row">
                        <p class="card-text product-price col-8">Start from RM<?php echo $food_list[3][6] ?></p>
                        <span class="btn col-1"><i class="fas fa-plus-square"></i></span>
                    </div>
                </div>
            </div>
        </div> 
    </div>

    <br>
    <!-- Section -->
    <a name="link2"></a>
    <div class="section-title">
        <h2><?php echo $category_name[1][2]; ?></h2>
    </div>

    <!-- products -->
    <div class="row padding" id="card">
        <!-- single product -->
        <div class="products-center col-2">
            <div class="card">
                <?php echo $food_list[4][8] ?>
                <div class="card-body">
                    <h6 class="card-title col-12"><?php echo $food_list[4][6] ?></h6>
                    <div class="row">
                        <p class="card-text product-price col-8">Start from RM<?php echo $food_list[4][7] ?></p>
                        <span class="btn col-1"><i class="fas fa-plus-square"></i></span>
                    </div>
                </div>
            </div>
        </div>

        <div class="products-center col-2">
            <div class="card">
                <?php echo $food_list[5][9] ?>
                <div class="card-body">
                    <h6 class="card-title col-12"><?php echo $food_list[5][7] ?></h6>
                    <div class="row">
                        <p class="card-text product-price col-8">Start from RM<?php echo $food_list[5][8] ?></p>
                        <span class="btn col-1"><i class="fas fa-plus-square"></i></span>
                    </div>
                </div>
            </div>
        </div>

        <div class="products-center col-2">
            <div class="card">
                <?php echo $food_list[6][10] ?>
                <div class="card-body">
                    <h6 class="card-title col-12"><?php echo $food_list[6][8] ?></h6>
                    <div class="row">
                        <p class="card-text product-price col-8">Start from RM<?php echo $food_list[6][9] ?></p>
                        <span class="btn col-1"><i class="fas fa-plus-square"></i></span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <br>
    <!-- Section -->
    <a name="link3"></a>
    <div class="section-title">
        <h2><?php echo $category_name[2][3]; ?></h2>
    </div>

    <!-- products -->
    <div class="row padding" id="card">
        <!-- single product -->
        <div class="products-center col-2">
            <div class="card">
                <?php echo $food_list[7][11] ?>
                <div class="card-body">
                    <h6 class="card-title col-12"><?php echo $food_list[7][9] ?></h6>
                    <div class="row">
                        <p class="card-text product-price col-8">Start from RM<?php echo $food_list[7][10] ?></p>
                        <span class="btn col-1"><i class="fas fa-plus-square"></i></span>
                    </div>
                </div>
            </div>
        </div>   

        <div class="products-center col-2">
            <div class="card">
                <?php echo $food_list[8][12] ?>
                <div class="card-body">
                    <h6 class="card-title col-12"><?php echo $food_list[8][10] ?></h6>
                    <div class="row">
                        <p class="card-text product-price col-8">Start from RM<?php echo $food_list[8][11] ?></p>
                        <span class="btn col-1"><i class="fas fa-plus-square"></i></span>
                    </div>
                </div>
            </div>
        </div> 

        <div class="products-center col-2">
            <div class="card">
                <?php echo $food_list[9][13] ?>
                <div class="card-body">
                    <h6 class="card-title col-12"><?php echo $food_list[9][11] ?></h6>
                    <div class="row">
                        <p class="card-text product-price col-8">Start from RM<?php echo $food_list[9][12] ?></p>
                        <span class="btn col-1"><i class="fas fa-plus-square"></i></span>
                    </div>
                </div>
            </div>
        </div> 
    </div>
</div>

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

<!-- javascript go here -->
<script>
    // this is to get the parameter using javascript
    const queryString = window.location.search;

    const urlParams = new URLSearchParams(queryString);

    const welcome = urlParams.get('welcome');

    //only alert when the user is logged in through login page
    $(document).ready(function() {
        if (welcome === "welcome") {s
            showAlert(0);
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