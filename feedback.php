<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "ecom";
$con = mysqli_connect($servername, $username, $password, $database);
if (!$con) {
    die("Not Connected" . mysqli_connect_error());
}

  $name = $boos = $emailid = $subject = $message = $nameerr = $emailiderr = $subjecterr = $messageerr = "";
    $bool = false;
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $emailid = $_POST['emailid'];
    $subject = $_POST['subject'];
    $message = $_POST['message'];
    $pattern = "^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$^"; 
    if (!preg_match("/^[a-z A-Z]*$/", $name)) {
      $nameerr = $error = "Please Enter Valid Name";
      $bool = true;
    }
    if (!preg_match($pattern, $emailid)) {
      $emailiderr = $error = "Please Provide valid email address";
      $bool = true;
    }  
    if (!preg_match("/^[a-zA-Z0-9]*$/", $subject)) {
      $subjecterr = $error = "Please Provide Correct Subject";
      $bool = true;
    }
    if (!preg_match("/^[a-zA-Z0-9]*$/", $message)) {
      $messageerr = $error = "Please Provide Correct Message";
      $bool = true;
    }
    if (!$bool) {
      echo "Her";
      $sql = "INSERT INTO `feedback` (`name`, `emailid`, `subject`, `msg`) VALUES ('$name', '$emailid', '$subject', '$message')";
      if ($con->query($sql)) {
        $boos = true;
      }
    }
  }
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <title>Organic Fruit Selling Platform</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    
    <link href="https://fonts.googleapis.com/css?family=Poppins:200,300,400,500,600,700,800&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Lora:400,400i,700,700i&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Amatic+SC:400,700&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="css/open-iconic-bootstrap.min.css">
    <link rel="stylesheet" href="css/animate.css">
    
    <link rel="stylesheet" href="css/owl.carousel.min.css">
    <link rel="stylesheet" href="css/owl.theme.default.min.css">
    <link rel="stylesheet" href="css/magnific-popup.css">

    <link rel="stylesheet" href="css/aos.css">

    <link rel="stylesheet" href="css/ionicons.min.css">

    <link rel="stylesheet" href="css/bootstrap-datepicker.css">
    <link rel="stylesheet" href="css/jquery.timepicker.css">

    
    <link rel="stylesheet" href="css/flaticon.css">
    <link rel="stylesheet" href="css/icomoon.css">
    <link rel="stylesheet" href="css/style.css">
  </head>
  <body class="goto-here">
    <nav class="navbar navbar-expand-lg navbar-dark ftco_navbar bg-dark ftco-navbar-light" id="ftco-navbar">
	    <div class="container">
	      <a class="navbar-brand" href="index.php">Organic Fruits</a>
	      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#ftco-nav" aria-controls="ftco-nav" aria-expanded="false" aria-label="Toggle navigation">
	        <span class="oi oi-menu"></span> Menu
	      </button>

	      <div class="collapse navbar-collapse" id="ftco-nav">
	        <ul class="navbar-nav ml-auto">
	          <li class="nav-item"><a href="index.php" class="nav-link">Home</a></li>
	          <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" id="dropdown04" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Shop</a>
              <div class="dropdown-menu" aria-labelledby="dropdown04">
              	<a class="dropdown-item" href="shop.php">Shop</a>
              </div>
            </li>
	          <li class="nav-item"><a href="about.php" class="nav-link">About</a></li>
            <li class="nav-item"><a href="#" class="nav-link">Account</a></li>
	          <li class="nav-item"><a href="#" class="nav-link">Register</a></li>
	          <li class="nav-item cta cta-colored"><a href="cart.php" class="nav-link"><span class="icon-shopping_cart"></span>[0]</a></li>

	        </ul>
	      </div>
	    </div>
	  </nav>

    <!-- END nav -->

    <div class="hero-wrap hero-bread" style="background-image: url('images/bg1.jpg');">
      <div class="container">
        <div class="row no-gutters slider-text align-items-center justify-content-center">
          <div class="col-md-9 ftco-animate text-center">
          	<p class="breadcrumbs"><span class="mr-2"><a href="index.php">Home</a></span> <span>Contact us</span></p>
            <h1 class="mb-0 bread">Contact us</h1>
          </div>
        </div>
      </div>
    </div>

    <section class="ftco-section contact-section bg-light">
      <div class="container">
        <div class="row block-9">
          <div class="col-md-12 order-md-last d-flex" style="padding: 50px;">
            <form action="feedback.php" method="post" class="bg-white p-5 contact-form">
              <div class="form-group">
                <input type="text" name="name" class="form-control" required placeholder="Your Name">
                <label style="color:red;"> <?php echo $nameerr ?> </label>
              </div>
              <div class="form-group">
                <input type="text"  name="emailid" class="form-control"  required placeholder="Your Email">
                <label style="color:red;"><?php  echo $emailiderr ?> </label>
              </div>
              <div class="form-group">
                <input type="text" name="subject" class="form-control" required placeholder="Subject">
                <label style="color:red;"><?php echo $subjecterr ?> </label>
              </div>
              <div class="form-group">
                <textarea id="" cols="30" rows="7" class="form-control"  name="message" required placeholder="Message"></textarea>
                <label style="color:red;"> <?php echo $messageerr ?> </label>
              </div>
              <div class="form-group">
                <input type="submit" value="Send Message"  class="btn  btn-primary py-3 px-5">
                <h2 style="text-align:center; color:orange;"><?php if($boos) {
                  echo "Thank You For Your Message";
                } ?></h2>
              </div>
            </form>
          
          </div>
        </div>
      </div>
    </section>

    <footer class="ftco-footer ftco-section">
      <div class="container">
      	<div class="row">
      		<div class="mouse">
						<a href="index.php" class="mouse-icon">
							<div class="mouse-wheel"><span class="ion-ios-arrow-up"></span></div>
						</a>
			</div>
      	</div>
        <div class="row">
          <div class="col-md-12 text-center">

            <p>
						  Copyright &copy;<script>document.write(new Date().getFullYear());</script> All rights reserved | This Application is made with <i class="icon-heart color-danger" style="color:red;" aria-hidden="true"></i>  Love
						</p>
          </div>
        </div>
      </div>
    </footer>
  

  <!-- loader -->
  <div id="ftco-loader" class="show fullscreen"><svg class="circular" width="48px" height="48px"><circle class="path-bg" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke="#eeeeee"/><circle class="path" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke-miterlimit="10" stroke="#F96D00"/></svg></div>

  
  <script>
    if ( window.history.replaceState ) {
        window.history.replaceState( null, null, window.location.href );
    }
  </script>

  <script src="js/jquery.min.js"></script>
  <script src="js/jquery-migrate-3.0.1.min.js"></script>
  <script src="js/popper.min.js"></script>
  <script src="js/bootstrap.min.js"></script>
  <script src="js/jquery.easing.1.3.js"></script>
  <script src="js/jquery.waypoints.min.js"></script>
  <script src="js/jquery.stellar.min.js"></script>
  <script src="js/owl.carousel.min.js"></script>
  <script src="js/jquery.magnific-popup.min.js"></script>
  <script src="js/aos.js"></script>
  <script src="js/jquery.animateNumber.min.js"></script>
  <script src="js/bootstrap-datepicker.js"></script>
  <script src="js/scrollax.min.js"></script>
  <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBVWaKrjvy3MaE7SQ74_uJiULgl1JY0H2s&sensor=false"></script>
  <script src="js/google-map.js"></script>
  <script src="js/main.js"></script>
    
  </body>
</html>