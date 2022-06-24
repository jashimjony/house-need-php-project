<?php
	//feedback page start
	
	//call header
	include ('header.php');

	//query to get feedback
	$sql = "SELECT * FROM he_feedback";
	$result = $connection->query($sql);
	$check = $result->num_rows;

	//display feedback
	echo '
		<div class="body-main body-admin">
			<div class="wrap">
				<h1 class="content-title">Feedback</h1>
				<hr>
				<br><br>
				<div class="single-content customer">
					<div class="title-customer">
						<h2>Feedback Received</h2>
					</div>
					<div class="table-content-customer">
	';
						//check have feedback or not
						if ($check > 0) {

							echo '
								<table border="1" class="customer-table">
									<tr>
										<th>User ID</th>
										<th>Name</th>
										<th>Rating</th>
										<th>Feedback</th>
									</tr>
							';

							//fetch all feedback
							while ($feedback = $result->fetch_array()) {

								echo '
									<tr>
										<td>'.$feedback['userID'].'</td>
										<td>'.$feedback['userName'].'</td>
										<td>'.$feedback['userRating'].' out of 5</td>
										<td>'.$feedback['feedback'].'</td>
									</tr>
								';
							}

							echo '
								</table>
							';

						} else {

							echo '<h3 style="width:100%;">No feedback yet</h3>';

						}
	echo '
					</div>
				</div>
			</div>
		</div>
	';

	//feedback page end

	//close connection
	$connection->close();
?>