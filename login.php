<?php
include_once('_cus.function.php');
include_once('cus_check.php');
if (havesession()) {
    header("location:dashboard.php"); //if the cookie or session is empty, go to login
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Restaurant | Login</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
    <link rel="stylesheet" href="./fontawesome-free-5.14.0-web/css/all.css">
    <link href="https://fonts.googleapis.com/css2?family=Baloo+Tammudu+2:wght@500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="./style/login.css">

    <!--JS for the show and hide passsword-->
    <script>
        function showpass() {
            var x = document.getElementById("password");
            if (x.type === "password") {
                x.type = "text";
            } else {
                x.type = "password";
            }
        }
    </script>
</head>

<body>
<!-- Navigation -->
<nav class="navbar navbar-expand navbar-light bg-light sticky-top">
    <div class="container-fluid">
        <a class="navbar-brand" href="index.php"><img src="img/res_logo.png" height=50>My Restaurant</a>
        <ul class="navbar-nav">
            <li class="nav-item">
                <a href="login.php" class="nav-link active">Login</a>
            </li>
            <li class="nav-item">
                <a href="register.php" class="nav-link">Sign Up</a>
            </li>
        </ul>
    </div>
</nav>

<!-- Login Form -->
<div class="modal-dialog text-center">
    <div class="col-12 main-section">
        <div class="modal-content">
            <div class="col-12 user-img">
                <img src="img/res_logo.png" width="130" height="120">
            </div>
            <hr>
            
            <div class="row">
                <div class="col-6"><h2>Sign In</h2></div>
                <div class="col-6 forgot"><a href="forgot.php">Forgot Password?</a></div>
            </div>

            <form action="login.php" method="POST" class="col-12">
                <div class="form-group">
                    <input name="username" type="text" class="form-control" placeholder="UserID or Email Address" required>
                    <span><?php echo $username_err; ?></span>
                </div>
                <div class="form-group password">
                    <input name="password" id="password" type="password" class="form-control" placeholder="Password" required>
                    <span><?php echo $password_err; ?></span>
                </div>
                <div class="col-12 checkbox">
                    <input type="checkbox" onclick="showpass()">
                    <label>Show Password</label>
                </div> 
                <div class="col-12 checkbox">
                    <input type="checkbox" name="remember">
                    <label>Remember Me</label>
                </div>
                <button class="btn col-12" name="submit" type="submit">Login</button>
                <div class="separator">Create New Account</div> 
                <button class="btn sign-up col-12" type="button" onclick="location.href='register.php';">Create New Account</button>
            </form>
        </div>
    </div>
</div>

<!-- Footer -->
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
			<div class="col-3">
                <a id="logo_a" href="index.php"><img src="img/res_logo_invert.png" width="65">My Restaurant</a>
				<hr>
                <a href="tel:0388699498">03-8869 9498</a><br><br>
                <a href="mailto:myrestaurant@gmail.com">myrestaurant@gmail.com</a><br><br>
				<p>100 Bukit Jalil</p>
				<p>Kuala Lumpur, Kuala Lumpur, 57000</p>
			</div>

			<div class="col-3">
				<hr>
				<h5>Our Hours</h5>
				<hr>
				<p>Monday: 9am - 5pm</p>
				<p>Saturday: 10am - 4pm</p>
				<p>Sunday: closed</p>
			</div>

			<div class="col-3">
				<hr>
				<h5>Service Area</h5>
				<hr>
				<p>Kuala Lumpur</p>
				<p>Shah Alam</p>
				<p>Subang Jaya</p>
				<p>Batu Caves</p>
			</div>

			<div class="col-3">
				<hr>
				<h5>Admin</h5>
				<hr>
				<a href="./adminlogin.php">Login</a>
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