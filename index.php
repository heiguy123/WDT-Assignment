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
	<link rel="stylesheet" href="./fontawesome-free-5.14.0-web/css/all.css">
	<link href="https://fonts.googleapis.com/css2?family=Baloo+Tammudu+2:wght@500&display=swap" rel="stylesheet">
	<link rel="stylesheet" href="./style/index.css">
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

<!--- Image Slider -->
<div class="carousel slide" id="slides" data-ride="carousel">
	<div class="carousel-inner">
		<div class="carousel-item active">
            <div class="row">
                <div class="col-3"><img src="img/noodle/蒜香虾油意面.jpg"></div>
                <div class="col-3"><img src="img/noodle/咖喱肥牛乌冬面.jpg"></div>
                <div class="col-3"><img src="img/noodle/岐山臊子面.jpg"></div>
                <div class="col-3"><img src="img/noodle/炒面.jpg"></div>
            </div>
        </div>
        <div class="carousel-item">
            <div class="row">
                <div class="col-3"><img src="img/noodle/牛肉炒粿条.jpg"></div>
                <div class="col-3"><img src="img/economic/糖醋排骨.jpg"></div>
                <div class="col-3"><img src="img/noodle/岐山臊子面.jpg"></div>
                <div class="col-3"><img src="img/noodle/红烧牛肉面.jpg"></div>
            </div>
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

<!-- Banner -->
<div class="banner">
    <div class="container">
        <div class="text-center">
            <div class="col-12">
                <h4>Enjoy your food with My Restaurant Delivery Service</h4>
                <p>More than 20++ food and drinks available</p>
            </div>
            <div class="col-12">
                <button type="button" onclick="location.href='login.php';" class="btn btn-outline-light">LOGIN</button>
                <button type="button" onclick="location.href='register.php';" class="btn btn-primary">SIGN UP</button>
            </div>
        </div>
    </div>
</div>

<br>

<!--- Welcome Section -->
<div class="container-fluid padding">
  <div class="row welcome text-center">
    <div class="col-12">
      <h1>Hot Sale</h1>
    </div>
    <div class="col-12">
      <h4>Save more till 30% with Hot Sale items. Hot Sale items will renew every weekend.</h4>
    </div>
  </div>
</div>

<!-- Card -->
<div class="container">
    <div class="row padding" id="card">
        <div class="col-4">
            <div class="card" data-toggle="modal" data-target="#pic1">
                <img class="card-img-top" src="img/noodle/蒜香虾油意面.jpg">
                <div class="card-body">
                    <h4 class="card-title">Udon and chili powder salad</h4>
                    <p class="card-text">A crunchy salad featuring udon and chili powder.</p>
                    <p class="card-text">cucumber | tomato | udon | chili powder</p>
                </div>
            </div>
        </div>

        <div class="modal fade" id="pic1" tabindex="-1" role="dialog">
            <div class="modal-dialog modal-dialog-centered" role="figure">
                <div class="modal-content">
                    <img src="./img/noodle/蒜香虾油意面.jpg">
                </div>
            </div>
        </div>

        <div class="col-4">
            <div class="card" data-toggle="modal" data-target="#pic2">
                <img class="card-img-top" src="img/economic/糖醋排骨.jpg">
                <div class="card-body">
                    <h4 class="card-title">Chilli and pineapple kebab</h4>
                    <p class="card-text">Skewer-cooked red chilli and fresh pineapple served in warm pitta pockets.</p>
                    <p class="card-text">onions | water | oil | chilli | pineapple</p>
                </div>
            </div>
        </div>

        <div class="modal fade" id="pic2" tabindex="-1" role="dialog">
            <div class="modal-dialog modal-dialog-centered" role="figure">
                <div class="modal-content">
                    <img src="./img/economic/糖醋排骨.jpg">
                </div>
            </div>
        </div>

        <div class="col-4">
            <div class="card" data-toggle="modal" data-target="#pic3">
                <img class="card-img-top" src="img/noodle/咖喱肥牛乌冬面re.png">
                <div class="card-body">
                    <h4 class="card-title">Salmon and squash wontons</h4>
                    <p class="card-text">Thin wonton cases stuffed with freshly-caught salmon and pattypan squash.</p>
                    <p class="card-text">flour | water | salt | onions | salmon | squash</p>
                </div>
            </div>
        </div>

        <div class="modal fade" id="pic3" tabindex="-1" role="dialog">
            <div class="modal-dialog modal-dialog-centered" role="figure">
                <div class="modal-content">
                    <img src="./img/noodle/咖喱肥牛乌冬面re.png">
                </div>
            </div>
        </div>

        <div class="col-4">
            <div class="card" data-toggle="modal" data-target="#pic4">
                <img class="card-img-top" src="img/noodle/岐山臊子面.jpg">
                <div class="card-body">
                    <h4 class="card-title">Beef and mushroom korma</h4>
                    <p class="card-text">Mild korma made with beef and chestnut mushroom.</p>
                    <p class="card-text">coriander | butter | sugar | beef | mushroom</p>
                </div>
            </div>
        </div>

        <div class="modal fade" id="pic4" tabindex="-1" role="dialog">
            <div class="modal-dialog modal-dialog-centered" role="figure">
                <div class="modal-content">
                    <img src="./img/noodle/岐山臊子面.jpg">
                </div>
            </div>
        </div>

        <div class="col-4">
            <div class="card" data-toggle="modal" data-target="#pic5">
                <img class="card-img-top" src="img/noodle/牛肉炒粿条.jpg">
                <div class="card-body">
                    <h4 class="card-title">Anise and pumpkin madras</h4>
                    <p class="card-text">Medium-hot madras made with fresh anise and spiced pumpkin.</p>
                    <p class="card-text">cumin | coriander | tomato | pumpkin</p>
                </div>
            </div>
        </div>

        <div class="modal fade" id="pic5" tabindex="-1" role="dialog">
            <div class="modal-dialog modal-dialog-centered" role="figure">
                <div class="modal-content">
                    <img src="./img/noodle/牛肉炒粿条.jpg">
                </div>
            </div>
        </div>
    </div>
</div>
  
<br><br><br>

<!--- Footer -->
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