<?php
	//Home page on user panel start

	//call header
	include ('header.php');

	//get user data from database
	$sql = "SELECT * FROM he_user WHERE userID='$userID'";
	$result = $connection->query($sql);
	$data = $result->fetch_array();

	//Change user detail function start

	//check form submission
	if (isset($_POST['fullname-save'])) {
		
		//get new name from form
		$fullname = $_POST['name'];

		//update new name
		$sql2 = "UPDATE he_user SET userName='$fullname' WHERE userID='$userID'";
		
		//give success message
		if ($connection->query($sql2) === TRUE) {

			echo'
	        	<div class="overlay">
					<div class="popup">
						<a class="close" href="index.php">&times;</a>
						<div class="content">
							<h2>Success</h2>
							<p>Your name changed !</p>
						</div>
					</div>
				</div>
        	';

		}

	} elseif (isset($_POST['contact-save'])) {
		
		//get new contact number
		$no = $_POST['contactno'];

		//update new contact number
		$sql3 = "UPDATE he_user SET userNo='$no' WHERE userID='$userID'";
		
		//give success message
		if ($connection->query($sql3) === TRUE) {

			echo'
	        	<div class="overlay">
					<div class="popup">
						<a class="close" href="index.php">&times;</a>
						<div class="content">
							<h2>Success</h2>
							<p>Your contact no changed !</p>
						</div>
					</div>
				</div>
        	';

		}

	} elseif (isset($_POST['gender-save'])) {
		
		//get new gender
		$gender = $_POST['gender'];

		//update new gender
		$sql4 = "UPDATE he_user SET userGender='$gender' WHERE userID='$userID'";
		
		//give success message
		if ($connection->query($sql4) === TRUE) {

			echo'
	        	<div class="overlay">
					<div class="popup">
						<a class="close" href="index.php">&times;</a>
						<div class="content">
							<h2>Success</h2>
							<p>Your gender changed !</p>
						</div>
					</div>
				</div>
        	';

		}

	} elseif (isset($_POST['pass-save'])) {
		
		//get new password
		$pass = $connection->real_escape_string($_POST['password']);
		//encrypt new password
		$password = md5($pass);

		//update new password
		$sql5 = "UPDATE he_user SET userPassword='$password' WHERE userID='$userID'";
		
		//give success message
		if ($connection->query($sql5) === TRUE) {

			echo'
	        	<div class="overlay">
					<div class="popup">
						<a class="close" href="index.php">&times;</a>
						<div class="content">
							<h2>Success</h2>
							<p>Your password changed. You can use new password on the next login !</p>
						</div>
					</div>
				</div>
        	';

		}

	}

	//Change user detail function end

	//display user account detail
	echo '
		<div class="body-main">
			<div class="wrap">
				<h1 class="content-title">Account</h1>
				<hr>
				<br><br>
				<div class="single-content user-account">
					<div class="user-form-account">
						<h4>User ID : '.$data['userID'].'</h4>
						<h4>Name : '.$data['userName'].' <button class="btn-change" onclick="openForm()">Change &gt;&gt;</button></h4>
						<div class="show-form" id="accountName">
							<form action="" method="POST">
								<input type="text" name="name" value="'.$data['userName'].'" required>
								<br><br>
								<button class="btn-submit" type="submit" name="fullname-save" value="'.$userID.'">Save</button>
								<button class="btn-submit" onclick="closeForm()">Cancel</button>
							</form>
						</div>
						<h4>Email : '.$data['userEmail'].'</h4>
						<h4>Contact No : '.$data['userNo'].' <button class="btn-change" onclick="openForm2()">Change &gt;&gt;</button></h4>
						<div class="show-form" id="accountContact">
							<form action="" method="POST">
								<input type="text" name="contactno" value="'.$data['userNo'].'" required>
								<br><br>
								<button class="btn-submit" type="submit" name="contact-save" value="'.$userID.'">Save</button>
								<button class="btn-submit" onclick="closeForm2()">Cancel</button>
							</form>
						</div>
						<h4>Gender : '.$data['userGender'].' <button class="btn-change" onclick="openForm3()">Change &gt;&gt;</button></h4>
						<div class="show-form" id="accountGender">
							<form action="" method="POST">
								<select name="gender" required>
									<option value="" selected disabled>Select Gender</option>
									<option value="Male">Male</option>
									<option value="Female">Female</option>
								</select>
								<br><br>
								<button class="btn-submit" type="submit" name="gender-save" value="'.$userID.'">Save</button>
								<button class="btn-submit" onclick="closeForm3()">Cancel</button>
							</form>
						</div>
						<h4>Password : ********** <button class="btn-change" onclick="openForm4()">Change &gt;&gt;</button></h4>
						<div class="show-form" id="accountPassword">
							<form action="" method="POST">
								<input type="password" name="password" placeholder="Insert your new password" required>
								<br><br>
								<button class="btn-submit" type="submit" name="pass-save" value="'.$userID.'" value="'.$userID.'">
									Save
								</button>
								<button class="btn-submit" onclick="closeForm4()">Cancel</button>
							</form>
							<br><br>
						</div>
					</div>
				</div>
				<br><br>
			</div>
		</div>
	';

	//call footer
	include ('footer.php');
?>