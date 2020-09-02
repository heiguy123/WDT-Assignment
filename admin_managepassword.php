<?php
include_once('_admin.function.php');
checksession();
$curPassErr = "";
$newPassErr = "";
$rePassErr = "";
if (isset($_POST['submit'])) {
    if ($errarray = changepassword()) { //failed
        if ($errarray['errtype'] == "new_pass") {
            $rePassErr = $errarray['msg'];
        } else if ($errarray['errtype'] == "cur_pass") {
            $curPassErr = $errarray['msg'];
        }
    };
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin | Manage Password</title>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
    <link rel="stylesheet" href="./fontawesome-free-5.14.0-web/css/all.css">
    <link href="https://fonts.googleapis.com/css2?family=Baloo+Tammudu+2:wght@500&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="./style/admin_managepassword.css">
    <script src="script/admin_managepassword.js"></script>
</head>

<body>

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
    <div class="modal-dialog text-center">
        <div class="col-12 main-section">
            <div id="user_info" class="modal-content">
                <div class="col-12 user-img">
                    <img src="img/admin/adminlogo.png" width="130" height="auto">
                </div>
                <hr>

                <div class="row">
                    <div class="col-12">
                        <h2>Manage Password</h2>
                    </div>
                </div>
                <form action="" method="POST" class="col-12">
                    <div class="form-group" id="curpassword">
                        <input type="password" name="cur_password" id="cur_pass" class="form-control" placeholder="Current Password" required>
                        <span id="curpasserr"><?php echo $curPassErr ?></span>
                    </div>
                    <div class="form-group" id="password">
                        <input type="password" name="password" id="pass" class="form-control" placeholder="Password" required>
                        <span id="passerr"><?php echo $newPassErr ?></span>
                    </div>
                    <div class="form-group" id="re-password">
                        <input type="password" name="re_password" id="re_pass" class="form-control" placeholder="Re-Enter Password" required>
                        <span id="repasserr"><?php echo $rePassErr ?></span>
                    </div>
                    <div class="col-12 checkbox">
                        <input type="checkbox" onclick="showpass()">
                        <label>Show Password</label>
                    </div>
                    <button class="btn col-12" type="submit" onclick="return validatePass()" name="submit">Save Change</button>
                </form>
            </div>
        </div>
    </div>
    <br><br>

    <!-- footer -->
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