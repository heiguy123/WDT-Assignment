<?php
include_once('_cus.function.php');
checksession();
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
    <link rel="stylesheet" href="./style/order.css">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
    <script src="script/cus_sortclosed.js"></script>
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
            <li class="nav-item help"><a href="#" class="nav-link">Help</a></li>
            <li class="nav-item order"><a href="order.php" class="nav-link">My Order</a></li>
            <li class="nav-item account"><a href="account.php" class="nav-link">Account Setting</a></li>
            <li class="nav-item logout"><a href="logout.php" class="nav-link">Logout</a></li>
            <hr>
            <li class="nav-item tel"><a href="tel:0388699498" class="nav-link">Contact Us</a></li>
            <li class="nav-item term"><a href="term.php" class="nav-link">Terms and Condition</a></li>
        </ul>
    </div>
</div>

<!-- main body container -->
<div class="container-fluid" id="maincontent">


    <!-- banner -->
    <div class="jumbotron jumbotron-fluid" id="welcome-banner">
        <div class="container">
            <h1 class="display-4" id="welcome-word">My Restaurant</h1>
            <h3 class="display-5">Food Ordering System</h3>
        </div>
    </div>

    <!-- navigation bar -->
    <nav class="directory navbar navbar-expand">
        <div class="container">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a href="order.php" class="nav-link active">Current Order</a>
                </li>
                <span> | </span>
                <li class="nav-item">
                    <a href="order_close.php" class="nav-link">History Order</a>
                </li>
            </ul>
        </div>
    </nav>

    <!-- seperator -->
    <div class="container">
        <hr>
    </div>
    <br>
    <!-- filter -->
    <div class="container filter">
        <div class="row">
            <div class="col float-right">
                <h4>Filter</h4>
            </div>
        </div>
        <div class="row">
            <div class=" col-md-9">
                <form id="sortbox">
                    <span class="radio">Sort by:</span>
                    <input type="radio" name="sortby" id="sdate" value="Time" checked> <span class="radio"> Time </span>
                    <input type="radio" name="sortby" id="stotal" value="Total"> <span class="radio"> Total</span>
                    <span class="radio">|</span>
                    <span class="radio">Order:</span>
                    <input type="radio" name="orderby" id="sasc" value="Acs" checked> <span class="radio"> Acs </span>
                    <input type="radio" name="orderby" id="sdesc" value="Desc"> <span class="radio"> Desc</span>
                </form>
            </div>

            <!-- Search Bar -->
            <form action="order.php" method="POST" class="col-3">
                <div class="search input-group float-right">
                    <input type="text" name="search" id="searchitem" class="form-control" value="" placeholder="Search order..">
                </div>
            </form>
        </div>
        <br>
    </div>


    <div class="container">
        <table class="table showorder">
            <thead class="thead-light">
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">ID</th>
                    <th scope="col">Payment Method</th>
                    <th scope="col">Time</th>
                    <th scope="col">Order Status</th>
                    <th scope="col">Total</th>
                </tr>
            </thead>
            <tbody id="viewbody">
                <?php displayclosed(0, 0,$_SESSION['cus_row']['cus_id']); ?>
            </tbody>
        </table>
    </div>

    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    ...
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Save changes</button>
                </div>
            </div>
        </div>
    </div>
<!-- end of body -->
</div>
<br><br>
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
 <!-- if (!empty($disableBtn)) {echo $disableBtn; echo $req0; echo $req1;} ?> -->
</body>
</html>