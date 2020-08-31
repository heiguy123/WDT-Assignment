<?php
include_once('_cus.function.php');
checksession();
getcartdetail();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Restaurant | Checkout</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <!-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous"> -->
    <link rel="stylesheet" href="./fontawesome-free-5.14.0-web/css/all.css">
    <link href="https://fonts.googleapis.com/css2?family=Baloo+Tammudu+2:wght@500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="./style/payment.css">
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
            <li class="nav-item back"><a href="cart.php" class="nav-link">Back</a></li>
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

<!-- Main content -->
<div class="main-content container mt-4 row col-12">
    <div class="col-8">
        <div class="col-12">
            <div class="card-left">
                <div class="pull-right" style="margin: 10px;">
                    <div class="text-left" style="width: 100%;">
                        <h1>Checkout</h1>
                        <div class="container-fluid box">
                            <h3>Delivery Address</h3>
                            <p><?php 
                            if (empty($_SESSION['cus_row']['street_name'])) {
                                echo $_SESSION['cus_row']['address'];
                            } else {
                                $street_name = $_SESSION['cus_row']['street_name'];
                                $city = $_SESSION['cus_row']['city'];
                                $postcode = $_SESSION['cus_row']['postcode'];

                                echo $street_name.','.$city.','.$postcode;
                            }
                            
                            
                            ?></p>
                        </div>

                        <div class="container-fluid box">
                            <h3>Select Payment</h3>
                            <article class="card" id="payment">
                                <div class="card-body p-4">
                                    <ul class="nav bg-light nav-pills rounded nav-fill mb-3" role="tablist">
                                        <li class="nav-item">
                                            <a class="btn btn-secondary active" data-toggle="pill" href="#nav-tab-card">
                                            <i class="fa fa-credit-card"></i>Credit Card</a></li>
                                        <li class="nav-item">
                                            <a class="btn btn-secondary" data-toggle="pill" href="#nav-tab-bank">
                                            <i class="fa fa-university"></i>Online Banking</a></li>
                                    </ul>

                                    <div class="tab-content">
                                        <div class="tab-pane fade show active" id="nav-tab-card">
                                            <!-- <p class="alert alert-success">Some text success or error</p> -->
                                            <form action="cus_payment.php" method="POST" role="form">
                                                <div class="form-group">
                                                    <label for="cus_full_name">Full name (on the card)</label>
                                                    <input type="text" class="form-control" name="cus_full_name" required>
                                                </div> <!-- form-group.// -->

                                                <div class="form-group">
                                                    <label for="card_num">Card number</label>
                                                    <div class="input-group">
                                                        <input type="text" class="form-control" name="card_num">
                                                        <div class="input-group-append">
                                                            <span class="input-group-text text-muted">
                                                                <i class="fab fa-cc-visa"></i>    
                                                                <i class="fab fa-cc-mastercard"></i> 
                                                            </span>
                                                        </div>
                                                    </div>
                                                </div> <!-- form-group.// -->

                                                <div class="row">
                                                    <div class="col-sm-8">
                                                        <div class="form-group">
                                                            <label><span class="hidden-xs">Expiration</span></label>
                                                            <div class="input-group">
                                                                <input type="number" class="form-control" placeholder="MM" name="MM" required>
                                                                <input type="number" class="form-control" placeholder="YY" name="YY" required>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-4">
                                                        <div class="form-group">
                                                            <label>CVV <i class="fa fa-question-circle"></i></label>
                                                            <input type="number" class="form-control" name="CVV" required>
                                                        </div> <!-- form-group.// -->
                                                    </div>
                                                </div> <!-- row.// -->
                                                <button class="subscribe btn btn-secondary btn-block" type="submit" name="card">Confirm</button>
                                            </form>
                                        </div> <!-- tab-pane.// -->

                                        <div class="tab-pane fade" id="nav-tab-bank">
                                            <form action="cus_payment.php" method="POST">
                                                <p>Bank Accaunt Details</p>
                                                <dl class="param">
                                                    <dt>BANK: </dt>
                                                    <dd> HONG LEONG BANK</dd>
                                                </dl>
                                                <dl class="param">
                                                    <dt>Accaunt number: </dt>
                                                    <dd> 12345678912345</dd>
                                                </dl>
                                                <dl class="param">
                                                    <dt>IBAN: </dt>
                                                    <dd> 123456789</dd>
                                                </dl>
                                                <p><strong>Note:</strong> The successful transaction will automatically tracked by system.</p>
                                                <button class="subscribe btn btn-secondary btn-block" type="submit" name="online_banking">I'm done</button>
                                            </form>                                        
                                        </div> <!-- tab-pane.// -->
                                    </div> <!-- tab-content .// -->
                                </div><!-- card-body.// -->
                            </article> <!-- card.// -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-4">
        <div class="col-12">
            <div class="card-right">
                <div class="pull-right" style="margin: 10px; margin-left: 120px">
                    <div class="pull-right" style="width: 100%;">
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
                        <hr>
                        <div class="row padding" style="font-size:20px; font-weight: bold;">
                            <div class="text-left col-6">Total (Incl. Service Tax): </div>
                            <div class="text-right col-3"><b>MYR </b></div>
                            <div class="text-left col-3"><b><?php echo $total; ?></b></div><br>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<br><br><br>
<br><br><br>

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