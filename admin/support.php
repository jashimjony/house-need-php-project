<?php
	//support page admin panel start

	//call header
	include ('header.php');

	//query to get all message receive
	$sql = "SELECT * FROM he_contact WHERE reply='NO'";
	$result = $connection->query($sql);
	$check = $result->num_rows;

	$sql2 = "SELECT * FROM he_contact WHERE reply='YES'";
	$result2 = $connection->query($sql2);
	$check2 = $result2->num_rows;

	//function mark message as read start

	//check form submission
	if (isset($_POST['reply'])) {
		
		//set message row id
		$id = $_POST['reply'];

		//update message status as read
		$sql3 = "UPDATE he_contact SET reply='YES' WHERE id='$id'";

		//give success message
		if ($connection->query($sql3)) {
			
			echo'
				<div class="overlay overlay-edit">
					<div class="popup item2">
						<a class="close" href="support.php">&times;</a>
						<div class="content">
							<h2>Success</h2>
							<p>Mark as replied.</p>
						</div>
					</div>
				</div>
			';

		}

	}

	//function mark message as read start

	//display all message
	echo '
		<div class="body-main body-admin">
			<div class="wrap">
				<h1 class="content-title">Support</h1>
				<hr>
				<br><br>
				<div class="single-content customer">
					<div class="title-customer">
						<h2>Message Received</h2>
					</div>
					<div class="table-content-customer">
	';
						//check have message or not
						if ($check > 0) {

							echo '
								<table border="1" class="customer-table">
									<tr>
										<th>Name</th>
										<th>Email</th>
										<th>Subject</th>
										<th>Message</th>
										<th>Replied ?</th>
										<th>Action</th>
									</tr>
							';

							//fetch all message
							while ($support = $result->fetch_array()) {

								echo '
									<tr>
										<td>'.$support['userName'].'</td>
										<td>'.$support['userEmail'].'</td>
										<td>'.$support['subject'].'</td>
										<td>'.$support['msg'].'</td>
										<td>'.$support['reply'].'</td>
										<td>
											<form action="" method="POST">
												<button type="submit" class="btn-submit support-btn" 
													name="reply" value="'.$support['id'].'">
														<i class="fas fa-check-circle"></i>
												</button>
											</form>
										</td>
									</tr>
								';
							}

							echo '
								</table>
							';

						} else {

							echo '<h3 style="width:100%;">No message received</h3>';

						}
	echo '
					</div>
				</div>
				<br>
				<div class="single-content customer">
					<div class="title-customer">
						<h2>Message Replied</h2>
					</div>
					<div class="table-content-customer">
	';
						//check have message or not
						if ($check2 > 0) {

							echo '
								<table border="1" class="customer-table">
									<tr>
										<th>Name</th>
										<th>Email</th>
										<th>Subject</th>
										<th>Message</th>
										<th>Replied ?</th>
									</tr>
							';

							//fetch all message
							while ($support2 = $result2->fetch_array()) {

								echo '
									<tr>
										<td>'.$support2['userName'].'</td>
										<td>'.$support2['userEmail'].'</td>
										<td>'.$support2['subject'].'</td>
										<td>'.$support2['msg'].'</td>
										<td>'.$support2['reply'].'</td>
									</tr>
								';
							}

							echo '
								</table>
							';

						} else {

							echo '<h3 style="width:100%;">No message replied</h3>';

						}
	echo '
					</div>
				</div>
				<br><br>
			</div>
		</div>
	';

	//suppport detail page end

	//close connection
	$connection->close();
?>