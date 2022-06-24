<?php
	//call header
	include ('header.php');

	//check user in session function
    if(!empty($_SESSION['user'])) {

        //redirect user if already logged in
		echo"<script>window.location='user/index.php';</script>";

	}

	//login function
    //check login form submission
    if (isset($_POST['login'])) {

        //check empty form for email and password
        if (empty($_POST['email']) || empty($_POST['password'])) {

            //give message fail for empty form input
            echo'
	        	<div class="overlay">
					<div class="popup">
						<a class="close" href="account.php">&times;</a>
						<div class="content">
							<h2>Failed</h2>
							<p>Please Fill Your Username or Password</p>
						</div>
					</div>
				</div>
        	';
        
        } else {

            //set value in variable
            $email = $_POST['email'];
            $password = $_POST['password'];

            //security purpose
            $email2 = stripslashes($email);
            $password2 = stripslashes($password);
            //escape all symbol that input in form
            $email3 = $connection->real_escape_string($email2);
            $password3 = $connection->real_escape_string($password2);

            //convert password as md5 encrypted hash
            $password4 = md5($password3);

            //get user detail
            $sql="SELECT userID,userEmail,userPassword,role FROM he_user WHERE userEmail='$email3' AND userPassword='$password4'";
            $result = $connection->query($sql);
            $verify = $result->num_rows;

            //check user exist or not
			if ($verify == 1) {

				//fecth user detail to get their role
				$getID = $result->fetch_array();

				//set value in variable
            	$id = $getID['userID'];
            	$role = $getID['role'];

            	//check user role
            	if ($role == 'CUSTOMER') {

            		//put and hold userID and role inside session
                	$_SESSION['user'] = $id;
              		$_SESSION['role'] = $role;
                    
                	//redirect page after success login
                	header("location:user/index.php");

                } elseif ($role == 'ADMIN') {

                	//put and hold userID and role inside session
                	$_SESSION['user'] = $id;
                	$_SESSION['role'] = $role;
                    
                	//redirect page after success login
                	header("location:admin/index.php");

                } else {

                	//give fail message for unauthorized user role
	                echo'
		        		<div class="overlay">
							<div class="popup">
								<a class="close" href="account.php">&times;</a>
								<div class="content">
									<h2>Failed</h2>
									<p>Unauthorized user attempt</p>
								</div>
							</div>
						</div>
	        		';

                }

            } else {

                //give message if email and password not match
                echo'
	        		<div class="overlay">
						<div class="popup">
							<a class="close" href="account.php">&times;</a>
							<div class="content">
								<h2>Failed</h2>
								<p>Email/Password Are Not Recognize</p>
							</div>
						</div>
					</div>
        		';
                   
            }
            
        }

    }

    //customer registeration function
    //check registeration form submission
	if (isset($_POST['register'])) {

		//escape all symbol that input in form
		$fname = $connection->real_escape_string($_POST['fname']);
        $lname = $connection->real_escape_string($_POST['lname']);
        $email = $connection->real_escape_string($_POST['email']);
        $password = $connection->real_escape_string($_POST['password']);
        $no = $connection->real_escape_string($_POST['contact']);
        $gender = $connection->real_escape_string($_POST['gender']);

        //combine first and last name
        $fullname = $fname . ' ' . $lname;

        //encrypt password as md5
        $pass = md5($password);

        //get customer data
        $search = "SELECT userEmail,role FROM he_user WHERE userEmail='$email'";
        $result = $connection->query($search);
        $verify = $result->num_rows;

        //check if data already exist in database
        if ($verify > 0) {
        	
        	//give fail message data already exist 
        	echo'
        		<div class="overlay">
					<div class="popup">
						<a class="close" href="account.php">&times;</a>
						<div class="content">
							<h2>Failed</h2>
							<p>Sorry, email already registered.</p>
						</div>
					</div>
				</div>
        	';

        } else {

        	//insert new data from registeration form
        	$sql = "INSERT INTO he_user(userName, userEmail, userPassword, userNo, userGender, role) 
        	VALUES ('$fullname', '$email', '$pass', '$no', '$gender', 'CUSTOMER')";

        	if ($connection->query($sql) === TRUE){

        		//give success message
	        	echo'
	        		<div class="overlay">
						<div class="popup">
							<a class="close" href="account.php">&times;</a>
							<div class="content">
								<h2>Success</h2>
								<p>Your account registered successfully. Now you can login to your account.</p>
							</div>
						</div>
					</div>
	        	';

	        } 
        }
	}

	//display login and registeration form
	echo '
		<div class="body-main">
			<div class="wrap">
				<br>
				<div class="account-content">
					<div class="account-grid-left">
						<h2>LOGIN</h2>
						<form action="" method="POST">
							<h4>Email</h4>
							<input type="email" name="email" required>
							<h4>Password</h4>
							<input type="password" name="password" required>
							<br><br>
							<button class="btn-submit" type="submit" name="login">Login</button>
							&nbsp;&nbsp;
							<button class="btn-submit" type="reset">Clear</button>
						</form>
					</div>
					<div class="account-grid-right">
						<h2>REGISTER</h2>
						<form action="" method="POST">
							<h4>First Name</h4>
							<input type="text" name="fname" required>
							<h4>Last Name</h4>
							<input type="text" name="lname" required>
							<h4>Email</h4>
							<input type="email" name="email" required>
							<h4>Password</h4>
							<input type="password" name="password" required>
							<h4>Contact No</h4>
							<input type="text" name="contact" required>
							<h4>Gender</h4>
							<select name="gender" required>
								<option value="" selected disabled>Select Gender</option>
								<option value="Male">Male</option>
								<option value="Female">Female</option>
							</select>
							<br><br>
							<button class="btn-submit" type="submit" name="register">Register</button>
							&nbsp;&nbsp;
							<button class="btn-submit" type="reset">Clear</button>
						</form>
					</div>
				</div>
				<br><br>
			</div>
		</div>
	';

?>