<?php
	//start session
	session_start();

	//get database connection
	require ('config.php');

	//search function
	//check form search submission
   	if(isset($_POST["submit_search"])) {

   		//redirect to search result page if form submitted
      	if(!empty($_POST["search"])) {

      		$query = str_replace(" ", "+", $_POST["search"]);
        	header("location:search.php?search=" . $query);
        	
        }
 	}

 	//display header
	echo'
		<!DOCTYPE html>
		<html>
			<head>
				<title>HouzNeed Electrical</title>
				<link rel="stylesheet" type="text/css" href="css/style.css" />
				<link rel="shortcut icon" type="image/icon" href="images/favicon.png"/>
				<link rel="stylesheet" href="css/all.css">
			</head>

			<body>
				<div class="header-main">
					<div class="wrap">
						<div class="search-bar">
							<form method="POST">
								<input type="text" name="search" placeholder="Search Product" value="';if(isset($_GET["search"])) echo $_GET["search"]; echo'" required>
								<button type="submit" name="submit_search" value=""><i class="fas fa-search"></i></button>
							</form>
						</div>
						
						<div class="mini-user-site">
							<a href="account.php"><i class="fas fa-user"></i>&nbsp;Account</a>
							&nbsp;&nbsp;&nbsp;
							<a href="user/cart.php"><i class="fas fa-shopping-cart"></i>&nbsp;Cart</a>
						</div>
						<hr>
						<ul class="main-menu">
							<li><a href="index.php">Home</a></li>
							<div class="dropdown">
								<li><a href="#">Shop</a><li>
								<div class="dropdown-content">
									<form action="category.php" method="GET">
										<button class="category" type="submit" name="all" value="All Products">
											All Products
										</button>
										<button class="category" type="submit" name="category" value="Home Appliances">
											Home Appliances
										</button>
										<button class="category" type="submit" name="category" value="Kitchen Appliances">
											Kitchen Appliances
										</button>
										<button class="category" type="submit" name="category" value="Digital">
											Digital
										</button>
									</form>
								</div>
							</div>
							
							<li><a href="contact.php">Contact Us</a><li>
						</ul>
					</div>
				</div>
	';
?>