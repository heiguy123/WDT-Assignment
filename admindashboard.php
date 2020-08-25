<?php
include_once('_admin.function.php');
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
    <title>Admin | Dashboard</title>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
    <link rel="stylesheet" href="./fontawesome-free-5.14.0-web/css/all.css">
    <link href="https://fonts.googleapis.com/css2?family=Baloo+Tammudu+2:wght@500&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="./style/admindashboard.css">
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
    <nav class="navbar navbar-expand-lg navbar-light bg-light">

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
                        <a class="dropdown-item" href="#">Current Order</a>
                        <a class="dropdown-item" href="#">Completed Order</a>
                        <!-- 
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="#">Something else here</a> 
                        -->
                    </div>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="#">View Menu</a>
                </li>
            </ul>

            <!-- navigation bar at the right side -->
            <ul class="navbar-nav navbar-right mr-auto">

                <li class="nav-item">
                    <a class="nav-link" href="#"><i class="fas fa-bell">
                            <span id="notification-number"></span>
                        </i></a>
                </li>

                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fas fa-user-cog"></i>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item account-list" href="#"><i class="fas fa-key"></i>Manage Password</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item account-list" href="?logout=1"><i class="fas fa-sign-out-alt"></i>Sign Out</a>
                        <!-- 
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="#">Something else here</a> 
                        -->
                    </div>
                </li>

            </ul>
        </div>


    </nav>
    <div class="container" id="maincontent">
        <!-- alert box for success login -->
        <div class="container" id="alert-box">
            <div class="alert alert-success" role="alert" id="login-alert">
                Successfully logged in as <b><?php echo $_SESSION['admin_row']['name'] ?></b>!
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        </div>
    </div>
    <!--- Footer -->
    <footer>
        <div class="container-fluid padding">
            <div class="row text-center padding">
                <div class="col-12 social padding">
                    <a href="#"><i class="fab fa-facebook"></i></a>
                    <a href="#"><i class="fab fa-twitter"></i></a>
                    <a href="#"><i class="fab fa-google-plus-g"></i></a>
                    <a href="#"><i class="fab fa-instagram"></i></a>
                    <a href="#"><i class="fab fa-youtube"></i></a>
                </div>
            </div>
        </div>

        <div class="container-fluid padding">
            <div class="row text-center">
                <div class="col-md-4">
                    <a id="logo_a" href="index.php"><img src="img/res_logo_invert.png" width="65">My Restaurant</a>
                    <hr class="light">
                    <a href="#">03-8869 9498</a><br><br>
                    <a href="#">myrestaurant@gmail.com</a><br><br>
                    <p>100 Bukit Jalil</p>
                    <p>Kuala Lumpur, Kuala Lumpur, 57000</p>
                </div>

                <div class="col-md-4">
                    <hr class="light">
                    <h5>Our Hours</h5>
                    <hr class="light">
                    <p>Monday: 9am - 5pm</p>
                    <p>Saturday: 10am - 4pm</p>
                    <p>Sunday: closed</p>
                </div>

                <div class="col-md-4">
                    <hr class="light">
                    <h5>Service Area</h5>
                    <hr class="light">
                    <p>Kuala Lumpur, 57000</p>
                    <p>Shah Alam, 40000</p>
                    <p>Subang Jaya, 47600</p>
                    <p>Batu Caves, 68100</p>
                </div>

                <div class="col-12">
                    <hr class="light">
                    <a href="#">&copy; myrestaurant.com</a>
                </div>
            </div>
        </div>
    </footer>
    <!-- 

    <button onclick="showAlert()">alert</button> -->
</body>

<!-- javascript go here -->
<script>
    // this is to get the parameter using javascript
    const queryString = window.location.search;

    const urlParams = new URLSearchParams(queryString);

    const welcome = urlParams.get('welcome');

    //only alert when the user is logged in through login page
    $(document).ready(function() {
        if (welcome === "welcome") {
            showAlert();
        }
    });

    function showAlert() {
        $("#alert-box").fadeTo(2000, 500).slideUp(500, function() {
            $("#alert-box").slideUp(500);
        });
    }
</script>

</html>