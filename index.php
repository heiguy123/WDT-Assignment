<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Restaurant</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
    <link rel="stylesheet" href="./fontawesome-free-5.14.0-web/css/all.css">
    <link href="https://fonts.googleapis.com/css2?family=Baloo+Tammudu+2:wght@500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="./css/index_style.css">
</head>
<body>
<!-- Navigation -->
<nav class="navbar navbar-expand-md navbar-light bg-light sticky-top">
    <div class="container-fluid">
        <a class="navbar-brand" href="index.php"><img src="img/res_logo.png" height=50>My Restaurant</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive"> 
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a href="#" class="nav-link active">Login</a>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link">Sign Up</a>
                </li>
            </ul>
        </div>
    </div>
</nav>

<!--- Image Slider -->
<div class="carousel slide" id="slides" data-ride="carousel">
	<div class="carousel-inner">
		<div class="carousel-item active">
			<img class="d-block w-100" src="img/noodle/蒜香虾油意面.jpg">
		</div>
		<div class="carousel-item">
			<img class="d-block w-100" src="img/noodle/岐山臊子面.jpg">
		</div>
		<div class="carousel-item">
			<img class="d-block w-100" src="img/rice/什锦蛋炒饭.jpg">
		</div>
		<div class="carousel-item">
			<img class="d-block w-100" src="img/economic/糖醋排骨.jpg">
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

<!-- Column Section -->
<div class="direct">
    <div class="container">
        <div class="text-center">
            <div class="col-md-12">
                <h4>Enjoy your food with My Restaurant Delivery Service</h4>
                <p>More than 20++ food and drinks available</p>
                <button type="button" class="btn btn-outline-light btn-lg">LOGIN</button>
                <button type="button" class="btn btn-primary btn-lg">SGIN UP</button>
            </div>
        </div>
    </div>
</div>

<br>

<!--- Welcome Section -->
<div class="container-fluid padding">
	<div class="row welcome text-center">
		<div class="col-12">
			<h1 class="display-4">Hot Sale</h1>
		</div>
		<br>
		<div class="col-12">
			<p class="lead">Save more till 30% with Hot Sale items. Hot Sale items will renew every weekend.
			</p>
		</div>
	</div>
</div>

<!-- Card -->
<div class="container-fluid padding">
	<div class="row padding">
		<div class="col-xs-12 col-sm-4 col-md-4">
			<div class="card">
				<a href="#"><img class="card-img-top" src="img/team1.png"></a>
				<div class="card-body">
					<h4 class="card-title">Hot Sale Item 1</h4>
					<p class="card-text">Description of Hot Sale Item.
					</p>
				</div>
			</div>
        </div>

        <div class="col-xs-12 col-sm-4 col-md-4">
			<div class="card">
				<img class="card-img-top" src="img/team1.png">
				<div class="card-body">
					<h4 class="card-title">Hot Sale Item 1</h4>
					<p class="card-text">Description of Hot Sale Item.
					</p>
				</div>
			</div>
        </div>

        <div class="col-xs-12 col-sm-4 col-md-4">
			<div class="card">
				<img class="card-img-top" src="img/team1.png">
				<div class="card-body">
					<h4 class="card-title">Hot Sale Item 1</h4>
					<p class="card-text">Description of Hot Sale Item.
					</p>
				</div>
			</div>
        </div>

        <div class="col-xs-12 col-sm-4 col-md-4">
			<div class="card">
				<img class="card-img-top" src="img/team1.png">
				<div class="card-body">
					<h4 class="card-title">Hot Sale Item 1</h4>
					<p class="card-text">Description of Hot Sale Item.
					</p>
				</div>
			</div>
        </div>

        <div class="col-xs-12 col-sm-4 col-md-4">
			<div class="card">
				<img class="card-img-top" src="img/team1.png">
				<div class="card-body">
					<h4 class="card-title">Hot Sale Item 1</h4>
					<p class="card-text">Description of Hot Sale Item.
					</p>
				</div>
			</div>
        </div>

        <div class="col-xs-12 col-sm-4 col-md-4">
			<div class="card">
				<img class="card-img-top" src="img/team1.png">
				<div class="card-body">
					<h4 class="card-title">Hot Sale Item 1</h4>
					<p class="card-text">Description of Hot Sale Item.
					</p>
				</div>
			</div>
		</div>
	</div>
</div>

<br><br><br>

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
				<img src="img/w3newbie.png">
				<hr class="light">
				<p>03-8869 9492</p>
				<p>myrestaurant@gmail.com</p>
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
				<p>Selangor, 57000</p>
				<p>Puchong, 57000</p>
				<p>Sri Aman, 57000</p>
			</div>

			<div class="col-12">
				<hr class="light-100">
				<h5>&copy; myrestaurant.com</h5>
			</div>
		</div>
	</div>
</footer>


</body>
</html>