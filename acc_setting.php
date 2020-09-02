<?php
include_once('_cus.function.php');
checksession();
if (isset($_POST['submit'])) {
    updateProfile(
        $_POST['username'],
        $_POST['email'],
        $_POST['nickname'],
        $_POST['contact'],
        $_POST['cur_pass'],
        $_POST['new_pass'],
        $_POST['conf_pass']
    );
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<title>My Restaurant | Account Setting</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
	<script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
	<!-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous"> -->
	<link rel="stylesheet" href="./fontawesome-free-5.14.0-web/css/all.css">
	<link href="https://fonts.googleapis.com/css2?family=Baloo+Tammudu+2:wght@500&display=swap" rel="stylesheet">
	<!-- <link rel="stylesheet" href="./css/account.css"> -->
	<link rel="stylesheet" href="./style/acc_setting.css">
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

<div class="main-content">
    <div class="container-fluid">
        <!-- User info -->
        <div class="row">
            <div class="col-12 m-auto order-1">
                <div class="card bg-secondary">
                    <form action="account.php" method="POST">
                        <div class="card-header bg-white border-0">
                            <div class="row align-items-center">
                                <div class="col-8">
                                    <h3 class="mb-0">My Profile</h3>
                                </div>

                                <div class="col-4 text-right">
                                    <button type="submit" name="submit" class="btn btn-sm btn-primary">Save Changes</a>
                                </div>
                            </div>
                        </div>

                        <div class="card-body">
                            <h6 class="heading-small text-muted mb-4">User information</h6>
                            <div class="pl-lg-4">
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="form-group focused">
                                            <label class="form-control-label" for="username">Username</label>
                                            <input type="text" id="username" name="username" class="form-control form-control-alternative" value="<?php echo $_SESSION['cus_row']['username'] ?>" readonly>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label class="form-control-label" for="email">Email address</label>
                                            <input type="email" id="email" name="email" class="form-control form-control-alternative" value="<?php echo $_SESSION['cus_row']['email'] ?>" required>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="form-group focused">
                                            <label class="form-control-label" for="nickname">Nickname</label>
                                            <input type="text" id="nickname" name="nickname" class="form-control form-control-alternative" value="<?php echo $_SESSION['cus_row']['cus_name'] ?>" required>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group focused">
                                            <label class="form-control-label" for="contact">Contact number</label>
                                            <input type="text" id="contact" name="contact" class="form-control form-control-alternative" value="<?php echo $_SESSION['cus_row']['contact'] ?>" required>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <hr class="my-4">

                            <!-- Password -->
                            <h6 class="heading-small text-muted mb-4">Password Setting</h6>
                            <div class="row">
                                <div class="col-lg-4">
                                    <div class="form-group focused">
                                        <label class="form-control-label" for="cur_pass">Current Password</label>
                                        <input type="password" id="cur_pass" name="cur_pass" class="form-control form-control-alternative">
                                    </div>
                                </div>

                                <div class="col-lg-4">
                                    <div class="form-group focused">
                                        <label class="form-control-label" for="new_pass">New Password</label>
                                        <input type="password" id="new_pass" name="new_pass" class="form-control form-control-alternative">
                                    </div>
                                </div>

                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label class="form-control-label" for="conf_pass">Confirm Password</label>
                                        <input type="password" id="conf_pass" name="conf_pass" class="form-control form-control-alternative">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

</body>
</html>