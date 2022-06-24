<?php
	//call header
	include ('header.php');

	//contact function
	//check contact form submission
	if (isset($_POST['contact'])) {
		
		//set value in variable
		$name = $connection->real_escape_string($_POST['fullname']);
        $email = $connection->real_escape_string($_POST['email']);
        $sub = $connection->real_escape_string($_POST['subject']);
        $msg = $connection->real_escape_string($_POST['message']);

        //query send message into database
        $sql = "INSERT INTO contact(userName, userEmail, subject, msg, reply) VALUES ('$name', '$email', '$sub', '$msg', 'NO')";

        //give success message
        if ($connection->query($sql) === TRUE){

        	echo'
        		<div class="overlay">
					<div class="popup">
						<a class="close" href="contact.php">&times;</a>
						<div class="content">
							<h2>Success</h2>
							<p>Thank you for contact us, we will reply on your email given :)</p>
						</div>
					</div>
				</div>
        	';

        }

	}

	//display contact form
	echo '
		<div class="body-main">
			<div class="wrap">
				<h1 class="content-title">Contact Us</h1>
				<hr>
				<br><br>
				<div class="single-content contact-us">
					<form action="" method="POST">
						<h4>Full Name</h4>
						<input type="text" name="fullname" required>
						<h4>Email</h4>
						<input type="email" name="email" required>
						<h4>Subject</h4>
						<input type="text" name="subject" required>
						<h4>Message</h4>
						<textarea rows="5" cols="147" name="message" required></textarea>
						<br><br>
						<button class="btn-submit" type="submit" name="contact">Submit</button>
						&nbsp;&nbsp;
						<button class="btn-submit" type="reset">Clear</button>
					</form>
				</div>
				<br><br>
			</div>
		</div>
	';

?>