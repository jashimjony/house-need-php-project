<?php
	//Order page user panel start

	//call header
	include ('header.php');

	//query to get user order
	$sql = "SELECT * FROM he_order WHERE userID='$userID'";
	$result = $connection->query($sql);
	$check = $result->num_rows;

	//feedback fucntion start 
	if (isset($_POST['feedback'])) {

		$sql_name = "SELECT userName FROM he_user WHERE userID='$userID'";
		$result_name = $connection->query($sql_name);
		$get_name = $result_name->fetch_array();
									
		$nameuser = $get_name['userName'];
		$rate = $_POST['rate'];
		$msg = $_POST['message'];

		$sql_fed = "INSERT INTO he_feedback(userID, userName, userRating, feedback) 
		VALUES ('$userID', '$nameuser', '$rate', '$msg')";

		if ($connection->query($sql_fed) === TRUE) {
			
			echo'
				<div class="overlay">
					<div class="popup">
						<a class="close" href="order.php">&times;</a>
						<div class="content">
							<h2>Feedback Sent</h2>
							<p>Thank you for your feedback. We will use that information to improve our services and products</p>
						</div>
					</div>
				</div>
			';

		}
				
	}
	//feedback function end

	echo '
		<div class="body-main">
			<div class="wrap">
				<h1 class="content-title">Order</h1>
				<hr>
				<br><br>
				<div class="single-content order">
	';
					//check have order or not
					if ($check > 0) {
						
						echo '	
							<form action="receipt.php" method="GET" target="_blank">
								<table border="1" class="order-table">
									<tr>
										<th>Order ID</th>
										<th>Date / Time</th>
										<th>Status</th>
										<th>View</th>
									</tr>
						';
									//fetch all order detail
									while ($order = $result->fetch_array()) {

										echo '
											<tr>
												<td>'.$order['orderID'].'</td>
												<td>'.$order['orderDate'].'</td>
												<td>'.$order['status'].'</td>
												<td>
													<button type="submit" class="btn-submit cart-remove" name="detail" value="'.$order['orderID'].'">
														<i class="fas fa-info-circle"></i>
													</button>
												</td>
											</tr>
										';
									}
						echo '

								</table>
							</form>

						';
					} else {

						echo '<h3 style="text-align:center;width:100%;">No order was made</h3>';

					}
	echo'
				</div>
				<br><br>
			</div>
		</div>
	';

	//call footer
	include ('footer.php');
?>