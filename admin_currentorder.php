<?php
include_once('_admin.function.php');
checksession();
if (isset($_POST['order_id'])) {
    update_orderstatus($_POST['order_id'], $_POST['order_status']);
}


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin | Current Order</title>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
    <link rel="stylesheet" href="./fontawesome-free-5.14.0-web/css/all.css">
    <link href="https://fonts.googleapis.com/css2?family=Baloo+Tammudu+2:wght@500&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="./style/admin_currentorder.css">
    <script src="script/admin_sortcurrent.js"></script>
</head>

<body>


    <!-- 
    1. dashboard : word
    1.view order : dropdown
        completed
        current
    4. view menu :word

    2. manage password :word
    3. notification icon for message :  icon
    5. sign out :icon -->

    <!-- navigation bar for admin-->
    <nav class="navbar navbar-expand-lg navbar-light bg-light sticky-top">

        <a class="navbar-brand" href="admindashboard.php"><img src="img/res_logo.png" alt="restaurant logo" height=36></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item active">
                    <a class="nav-link" href="admindashboard.php">Dashboard<span class="sr-only">(current)</span></a>
                </li>

                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        View Order
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="admin_currentorder.php">Current Order</a>
                        <a class="dropdown-item" href="admin_closedorder.php">Closed Order</a>
                        <!-- 
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="#">Something else here</a> 
                        -->
                    </div>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="admin_viewmenu.php">View Menu</a>
                </li>

            </ul>

            <!-- navigation bar at the right side -->
            <ul class="navbar-nav navbar-right mr-auto">

                <li class="nav-item">
                    <a class="nav-link" href="admin_viewrequest.php"><i class="fas fa-bell">
                            <span id="notification-number"><?php showrequestnumber() ?></span>
                        </i></a>
                </li>

                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fas fa-user-cog"></i>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item account-list" href="admin_managepassword.php"><i class="fas fa-key"></i>Manage Password</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item account-list" href="logout.php"><i class="fas fa-sign-out-alt"></i>Sign Out</a>
                        <!-- 
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="#">Something else here</a> 
                        -->
                    </div>
                </li>

            </ul>
        </div>


    </nav>



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
                        <a href="admin_currentorder.php" class="nav-link active">Current Order</a>
                    </li>
                    <span> | </span>
                    <li class="nav-item">
                        <a href="admin_closedorder.php" class="nav-link">Closed Order</a>
                    </li>
                </ul>
            </div>
        </nav>

        <!-- seperator -->
        <div class="container">
            <hr id="seperator">
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

                <!-- below is search function yet to explore -->
                <!-- <div class="col-md-3 ">

                    <form class="searchbox" action="">
                        <div class="float-right">
                            <input class="form-control" type="text" name="searchitem" placeholder="Search..">
                        </div>
                    </form>

                </div> -->
            </div>
            <br>
        </div>


        <div class="container">
            <table class="table showorder">
                <thead class="thead-light">
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">ID</th>
                        <th scope="col">Customer Name</th>
                        <th scope="col">Payment Method</th>
                        <th scope="col">Time</th>
                        <th scope="col">Order Status</th>
                        <th scope="col">Total</th>
                    </tr>
                </thead>
                <tbody id="viewbody">
                    <?php displaycurrent(0, 0); ?>
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

    <!-- footer -->
    <footer>
        <div class="container-fluid padding">
            <div class="row text-center">
                <div class="col-12 social">
                    <a href="https://www.facebook.com" target="_blank"><i class="fab fa-facebook"></i></a>
                    <a href="https://www.twitter.com" target="_blank"><i class="fab fa-twitter"></i></a>
                    <a href="https://www.google.com" target="_blank"><i class="fab fa-google-plus-g"></i></a>
                    <a href="https://www.instagram.com" target="_blank"><i class="fab fa-instagram"></i></a>
                    <a href="https://www.youtube.com" target="_blank"><i class="fab fa-youtube"></i></a>
                </div>
            </div>
        </div>

        <div class="container-fluid padding">
            <div class="row text-center">
                <div class="col-md-4">
                    <a id="logo_a" href="index.php"><img src="img/res_logo_invert.png" width="65">My Restaurant</a>
                    <hr>
                    <a href="tel:0388699498">03-8869 9498</a><br><br>
                    <a href="mailto:myrestaurant@gmail.com">myrestaurant@gmail.com</a><br><br>
                    <p>100 Bukit Jalil</p>
                    <p>Kuala Lumpur, Kuala Lumpur, 57000</p>
                </div>

                <div class="col-md-4">
                    <hr>
                    <h5>Our Hours</h5>
                    <hr>
                    <p>Monday: 9am - 5pm</p>
                    <p>Saturday: 10am - 4pm</p>
                    <p>Sunday: closed</p>
                </div>

                <div class="col-md-4">
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
</body>



</html>