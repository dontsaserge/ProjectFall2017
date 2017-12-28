<?php session_start();  

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title><?php echo $page_title;  ?></title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <link type="text/css" rel="stylesheet" href="styles/style.css">
 </head>
<body>
<nav class="navbar navbar-default navbar-fixed-top">
  <div class="container">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>                        
      </button>
      <a class="navbar-brand active" href="index.php">CIS-485</a>
    </div>
    <div class="collapse navbar-collapse" id="myNavbar">
      <ul class="nav navbar-nav">
        <li class="active"><a href="index.php">Home</a></li>
        <li><a href="view_cart.php">Your Cart</a></li>
        <li><a href="aboutus.php">About Us</a></li>
      </ul>
      <ul class="nav navbar-nav navbar-right">
      <li>
      <?php
		  if(!isset($_SESSION['user_level'])){
			
			  echo("<form action='signin.php' method='POST'><button type='submit' class='btn btn-primary'>Sign in</button></form>");
		  }else{
			  echo("<form action='logout.php' method='POST'><button type='submit' class='btn btn-default'>Sign out</button></form>");
			 // echo($_SESSION['fname']);
		  }
		  ?>              
        </li>
      </ul>
    </div>
  </div>
</nav>




