<?php
//include auth_session.php file on all user panel pages
include("allow_session.php");
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <link rel="stylesheet" href="bootstrap-4.3.1/dist/css/bootstrap.min.css">
    <meta charset="utf-8">
    <meta http-equiv="refresh" content="60">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Su Jin Shin, Jason Dong, Zackary Sikkink, Sam Gaussman, and Bootstrap contributors">
    <meta name="generator" content="Hugo 0.104.2">
    <title>Dashbboard</title>
    <link rel="canonical" href="https://getbootstrap.com/docs/5.2/examples/product/">
    
    <!-- Custom styles for this template -->
    <link href="product.css" rel="stylesheet">
  </head>
  <body>

<section> <!-- top navigation bar-->
<header class="site-header sticky-top py-1">
  <nav class="container d-flex flex-column flex-md-row justify-content-between">
    <a class="py-2 d-none d-md-inline-block" href="index.html">Home</a>
    <a class="py-2 d-none d-md-inline-block" href="dashboard.php">Dashboard</a>
    <a class="py-2 d-none d-md-inline-block" href="joinCreateClass.php">Join/Create a Class</a>
    <a class="py-2 d-none d-md-inline-block" href="logout.php">Logout</a>
  </nav>
</header>
</section>

<section> <!-- main section with the slogan and components of website-->
  <main>
    <div class="position-relative overflow-hidden p-3 p-md-5 m-md-3 text-center bg-light">
      <div class="col-md-5 p-lg-5 mx-auto my-5">
        <h1 class="display-4 fw-normal">Hello, <span style = "color: red"><?php echo ucfirst($_SESSION['grade'])?></span> <?php echo ucfirst($_SESSION["firstname"])?> <?php echo ucfirst($_SESSION["lastname"])?>!</h1>
      </div>
      <div class="product-device shadow-sm d-none d-md-block"></div>
      <div class="product-device product-device-2 shadow-sm d-none d-md-block"></div>
    </div>
  </div>
</footer>
</section>
<script src="bootstrap-4.3.1/dist/css/bootstrap.min.css"></script>     
  </body>
</html>