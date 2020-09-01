<?php
include_once('_cus.function.php');
checksession();
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Restaurant | Receipt</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <!-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous"> -->
    <link rel="stylesheet" href="./fontawesome-free-5.14.0-web/css/all.css">
    <link href="https://fonts.googleapis.com/css2?family=Baloo+Tammudu+2:wght@500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="./style/verify_payment.css">
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
            <div class="nav-nav" style="right: 20px;">
                <li class="navbar-nav"><a href="account.php" class="nav-link"><?php echo $_SESSION['cus_row']['cus_name'] ?></a></li>
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
            <li class="nav-item account"><a href="account.php" class="nav-link">Account Setting</a></li>
            <li class="nav-item logout"><a href="logout.php" class="nav-link">Logout</a></li>
            <hr>
            <li class="nav-item tel"><a href="tel:0388699498" class="nav-link">Contact Us</a></li>
            <li class="nav-item term"><a href="term.php" class="nav-link">Terms and Condition</a></li>
        </ul>
    </div>
</div>

<!-- Verification Message -->
<div class="modal-dialog text-center">
    <div class="col-12 main-section">
        <div class="modal-content">
            <div class="col-12 user-img">
                <img src="img/res_logo.png" width="130" height="120">
            </div>
            <div class="col-12 text-center">
                <h2>The order has been placed</h2>
                <br>
                <h5>Thanks for ordering! <br> We sent an email-receipt to</h5>
                <p><a href="https://www.gmail.com" target="_blank"><?php echo $_GET['email']; ?></a></p>
                <h5>Just click on the link in that email to track your order.
                If you don’t see it, you may need to check your spam folder.</h5>

                <br><br>

                <button class="btn" onclick="location.href='dashboard.php';">Back Home</button>
            </div>
            <br><br>
          
            <div class="row" id="verify-bottom">
                <div class="col-6" style="text-align: right;">
                    <h5>Need help?</h5>
                </div>
                <div class="col-6" style="text-align: left; top: -3px; left: -18px;"><a href="tel:0388699498">Contact Us?</a></div>
            </div>
        </div>
    </div>
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
</body>
</html>