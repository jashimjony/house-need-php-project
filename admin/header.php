<?php
	//header admin panel start

	//start session
	session_start();

	//get database connection
	require ('../config.php');

	//check admin in session
    if (empty($_SESSION['user'])) {

    	//redirect page if no admin in session
		echo"<script>window.location='../account.php';</script>";

	}

	//check user role
	if ($_SESSION['role'] != 'ADMIN') {
		
		//redirect page if the user not admin
		header('location:../404.php');

	}

	//fucntion logout start
    //check logout form submssion
    if (isset($_POST['logout'])) {

        //check user in session
        if (!empty($_SESSION['user'])) {
            
            //unset current user session
            unset($_SESSION['user']);
            
            //redirect page after logout success
            header("Location: ../account.php"); 

        }

    }
    //fucntion logout end

    //get userID from session
    $userID = $_SESSION['user'];

    //query to get user detail 
    $sql = "SELECT userName FROM he_user WHERE userID='$userID'";
    $result = $connection->query($sql);
    $user = $result->fetch_array();

    //display header content
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
				<div class="header-main admin">
					<div class="wrap">
						<div class="title-admin-panel">
							<h2>Admin Panel</h2>
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
							<li><a href="index.php">Dashboard</a></li>
							<li><a href="item.php">Item</a></li>
							<li><a href="order.php">Order</a></li>
							<li><a href="customer.php">Customer</a></li>
							<li><a href="support.php">Support</a></li>
							<li><a href="feedback.php">Feedback</a></li>
							<li><a href="setting.php">Setting</a></li>
						</ul>
					</div>
				</div>
	';
?>