<?php
include_once('_admin.function.php');
checksession();
if (isset($_GET['del'])) {
    deletefood($_GET['del']);
}
if (isset($_POST['food_id'])) {
    updatefood();
}
if (isset($_POST['newfood_name'])) {
    insertfood();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin | View Menu</title>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
    <link rel="stylesheet" href="./fontawesome-free-5.14.0-web/css/all.css">
    <link href="https://fonts.googleapis.com/css2?family=Baloo+Tammudu+2:wght@500&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="./style/admin_viewmenu.css">
    <script src="script/admin_viewmenu.js"></script>
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

        <!-- modal for new food -->
        <div class="modal fade" id="exampleModal-1" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabelnew" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <form action="" method="POST" id="formnew" enctype="multipart/form-data">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabelnew">Food Detail</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                        </div>
                        <div class="modal-body container">

                            <div class="row">

                                <div class="col-2">

                                    <span>Name : </span>
                                    <br><br>
                                    <span>Category: </span>
                                    <br><br>
                                    <span>Price: </span>
                                    <br><br>
                                    <span>Description: </span>
                                </div>

                                <div class="col-5 fooddetails">

                                    <input type="text" name="newfood_name" required>
                                    <br><br>
                                    <input list="cate" name="newcategory" required>
                                    <datalist id="cate">
                                        <?php insertcatelist() ?>
                                    </datalist>
                                    <br><br>
                                    <input type="number" step="0.01" name="newfood_price" required=>
                                    <br><br>
                                    <textarea name="newfood_desc" required=""></textarea>
                                </div>

                                <div class="col-5">

                                    <span>Picture: </span>
                                    <div class="foodimgcontainer row">
                                        <div class="col">
                                            <img id="img-1" class="foodimg" style="max-width:300px; max-height:200px" src="img/default.jpg" alt="food">
                                            <br>
                                            <input name="newfoodimg" class="hidden" id="uploadimg-1" type="file" onchange="readURL(this,'img-1');">
                                            <label for="uploadimg-1" class="uploadbutton">Select file</label>
                                        </div>
                                    </div>
                                    <br><br>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">

                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button id="resetbutton-1" type="reset" class="btn btn-success" onclick="resetimg(-1)">Reset</button>
                            <button name="newsubmit" type="submit" id="-1" class="btn btn-primary float-right" onclick="return validateform(this)">Add New</button>

                        </div>
                    </form>
                </div>
            </div>
        </div>

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
                <div class="col-md-3">
                    <h4>Category </h4>
                </div>
                <div class="row">
                    <div class="col">
                        <ul class="navbar-nav float-right">
                            <?php displaycate(); ?>
                        </ul>
                    </div>
                </div>
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
                <!-- below is search function yet to explore -->
                <div class="col-md-12 float-right">
                    <button type="button" class="btn btn-info" data-toggle="modal" data-target="#exampleModal-1">New Food</button>
                    <!-- <form class="searchbox" action="admin_search.php"> -->
                    <div class="float-right">
                        <input class="form-control searchbox" type="text" id="searchitem" placeholder="Search name..">
                    </div>
                    <!-- </form> -->

                </div>
            </div>
            <br>
        </div>
        <!-- seperator -->
        <div class="container">
            <hr id="seperator">
        </div>

        <!-- to do here -->
        <div class="container" id="viewcontent">
            <table class="table showorder">
                <thead class="thead-light">
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Name</th>
                        <th scope="col">Category</th>
                        <th scope="col">Price</th>
                    </tr>
                </thead>
                <tbody id="viewbody">
                    <?php displaymenulist(); ?>
                </tbody>
            </table>
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