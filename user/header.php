<?php
	//Header User Panel start

	//start session
	session_start();

	//get database connection
	require ('../config.php');

	//check user in session
    if (empty($_SESSION['user'])) {

    	//redirect user to login page if user not log in yet
		echo"<script>window.location='../account.php';</script>";

	}

    //check logout form submission
    if (isset($_POST['logout'])) {

        //check user session
        if (!empty($_SESSION['user'])) {
            
            //unset current user session
            unset($_SESSION['user']);
            
            //redirect page after logout success
            header("Location: ../account.php"); 

        }

    }

   	//search function
	//check form search submission
   	if(isset($_POST["submit_search"])) {

   		//redirect to search result page if form submitted
      	if(!empty($_POST["search"])) {

      		$query = str_replace(" ", "+", $_POST["search"]);
        	header("location:../search.php?search=" . $query);
        	
        }
 	}

 	//set user session in variable
    $userID = $_SESSION['user'];

    //get user name from database
    $sql = "SELECT userName FROM he_user WHERE userID='$userID'";
    $result = $connection->query($sql);
    $user = $result->fetch_array(); 

    //display header
	echo'
		<!DOCTYPE html>
		<html>
			<head>
				<title>HouzNeed Electrical</title>
				<link rel="stylesheet" type="text/css" href="../css/style.css" />
				<link rel="shortcut icon" type="../image/icon" href="../images/favicon.png"/>
				<link rel="stylesheet" href="../css/all.css">
			</head>

			<body>
				<div class="header-main user">
					<div class="wrap">
						<div class="search-bar">
							<form method="POST">
								<input type="text" name="search" placeholder="Search Product" value="';if(isset($_GET["search"])) echo $_GET["search"]; echo'" required>
								<button type="submit" name="submit_search" value=""><i class="fas fa-search"></i></button>
							</form>
						</div>
						<div class="logo-main">
							<a href="../index.php"><img src="../images/logo.png" width="100px" height="100px"></a>
						</div>
						<div class="mini-user-site">
							<a href="index.php"><i class="fas fa-user"></i>&nbsp;'.$user['userName'].'</a>
							<form action="" method="POST">
								<button class="btn-logout" type="submit" name="logout">
									<i class="fas fa-sign-out-alt"></i>&nbsp;Logout
								</button>
							</form>
						</div>
						<hr>
						<br>
						<ul class="main-menu">
							<li><a href="../index.php">Shop</a></li>
							<li><a href="index.php">Account</a></li>
							<li><a href="cart.php">Cart</a></li>
							<li><a href="order.php">Ordered</a></li>
						</ul>
					</div>
				</div>
	';
?>