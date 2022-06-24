<?php
	//setting page admin panel start 

	//call header
	include ('header.php');

	//query to ger user detail
	$sql = "SELECT * FROM he_user WHERE role='ADMIN'";
	$result = $connection->query($sql);
	$check = $result->num_rows;

	//function add new user start

	//check form submission
	if (isset($_POST['open-new-form'])) {

		//display form
		echo'
			<div class="overlay overlay-edit">
				<div class="popup item">
					<a class="close" href="setting.php">&times;</a>
					<div class="content">
						<h2>Add New User</h2>
						<form action="setting.php" method="POST">
							<h4>Fullname :</h4>
							<input type="text" name="name" reuqired>
							<h4>Email :</h4>
							<input type="email" name="email" reuqired>
							<h4>Password :</h4>
							<input type="password" name="pass" required>
							<br><br>
							<button type="submit" class="btn-submit save-item-page" name="add-new-user">
								Save
							</button>
							<button type="clear" class="btn-submit save-item-page">
								Clear
							</button>
						</form>
					</div>
				</div>
			</div>
		';

	}

	//check form submission
	if (isset($_POST['add-new-user'])) {

		//set value as variable
		$name = $connection->real_escape_string($_POST['name']);
		$email = $connection->real_escape_string($_POST['email']);
        $pass = $connection->real_escape_string($_POST['pass']);

        //encrypt password
        $pass = md5($password);
		
		//save new user	
		$sql2 = "INSERT INTO he_user(userName, userEmail, userPassword, role)
		VALUES ('$name', '$email', '$pass', 'ADMIN')";

		//give success message
		if ($connection->query($sql2) === TRUE) {
				
			echo'
				<div class="overlay overlay-edit">
					<div class="popup item2">
						<a class="close" href="setting.php">&times;</a>
						<div class="content">
							<h2>Success</h2>
							<p>New User Added.</p>
						</div>
					</div>
				</div>
			';

		}
	}

	//function add new user end

	//function delete user start

	//check form submission
	if (isset($_POST['delete-user'])) {
		
		//set userID as variable
		$userID = $_POST['delete-user'];

		//delete user from database
		$sql6 = "DELETE FROM he_user WHERE userID='$userID'";

		//give success message
		if ($connection->query($sql6) === TRUE) {
				
			echo'
				<div class="overlay overlay-edit">
					<div class="popup">
						<a class="close" href="setting.php">&times;</a>
						<div class="content">
							<h2>Success</h2>
							<p>User deleted.</p>
						</div>
					</div>
				</div>
			';

		}

	}
	//function delete user end

	//display user
	echo '
		<div class="body-main body-admin">
			<div class="wrap">
				<h1 class="content-title">User - Admin</h1>
				<hr>
				<br><br>
				<div class="single-content item">
					<form action="" method="POST" class="addnewitem-section">
						<button type="submit" class="btn-submit save-item-page" name="open-new-form">
							Add New User
						</button>
					</form>
				</div>
				<div class="single-content item">
					<form action="" method="POST">
						<br>
	';
					//check have user detail or not
					if ($check > 0) {

						echo '
								<table border="1" class="item-table">
									<tr>
										<th>ID</th>
										<th>Name</th>
										<th>Email</th>
										<th>Role</th>
										<th class="item-action">Action</th>
									</tr>
						';

						//fetch all user detail
						while ($user = $result->fetch_array()) {

							echo '
								<tr>
									<td>'.$user['userID'].'</td>
									<td>'.$user['userName'].'</td>
									<td>'.$user['userEmail'].'</td>
									<td>'.$user['role'].'</td>
									<td>
										<div class="setting-action-wrap">
										<button type="submit" class="btn-submit item-page" name="delete-user" value="'.$user['userID'].'">
											<i class="fas fa-trash-alt"></i>
										</button>
										</div>
									</td>
								</tr>
							';
						}

						echo '
								</table>
						';

					} else {

						echo '<h3 style="width:100%;">No user found</h3>';

					}
	echo '
					</form>
				</div>
				<br><br>
			</div>
		</div>
	';

	//setting page admin panel end

	//close connection
	$connection->close();
?>