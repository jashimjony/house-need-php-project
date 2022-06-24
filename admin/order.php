<?php
	//call header
	include ('header.php');

	//query to get all order
	$sql = "SELECT * FROM he_order WHERE payStatus='PAID' AND status='PROCESSING'";
	$result = $connection->query($sql);
	$check = $result->num_rows;

	$sql2 = "SELECT * FROM he_order WHERE payStatus='PAID' AND status='SHIPPED'";
	$result2 = $connection->query($sql2);
	$check2 = $result2->num_rows;

	$sql3 = "SELECT * FROM he_order WHERE payStatus='PAID' AND status='COMPLETED'";
	$result3 = $connection->query($sql3);
	$check3 = $result3->num_rows;

	//function manage order start

	//check form submission
	if (isset($_POST['manage-order'])) {
		
		//set orderID in variable
		$orderID = $_POST['manage-order'];

		//update order as shipped
		$sql4 = "UPDATE he_order SET status='SHIPPED' WHERE orderID='$orderID'";

		//give success message
		if ($connection->query($sql4) === TRUE) {
			
			echo'
				<div class="overlay overlay-edit">
					<div class="popup item2">
						<a class="close" href="order.php">&times;</a>
						<div class="content">
							<h2>Success</h2>
							<p>Order Shipped.</p>
						</div>
					</div>
				</div>
			';

		}

	}

	if (isset($_POST['manage-order2'])) {
		
		//set orderID in variable
		$orderID = $_POST['manage-order2'];

		//update order as completed
		$sql5 = "UPDATE he_order SET status='COMPLETED' WHERE orderID='$orderID'";

		//give success message
		if ($connection->query($sql5) === TRUE) {
			
			echo'
				<div class="overlay overlay-edit">
					<div class="popup item2">
						<a class="close" href="order.php">&times;</a>
						<div class="content">
							<h2>Success</h2>
							<p>Order Completed.</p>
						</div>
					</div>
				</div>
			';

		}

	}

	//function manage order end

	//display order content
	echo '
		<div class="body-main body-admin">
			<div class="wrap">
				<h1 class="content-title">Order</h1>
				<hr>
				<br><br>
				<div class="single-content order-admin">
					<div class="title-order-admin">
						<h2>New Order</h2>
					</div>
					<div class="table-content-order">
	';
						//check have order or not
						if ($check > 0) {

							echo '
								<table border="1" class="order-admin-table">
									<tr>
										<th>Order ID</th>
										<th>Name</th>
										<th>Email</th>
										<th>Contact No</th>
										<th>Status</th>
										<th>Address</th>
										<th class="order-admin-action">Action</th>
									</tr>
							';

							//fetch all new order detail
							while ($order = $result->fetch_array()) {

								echo '
									<tr>
										<td>'.$order['orderID'].'</td>
										<td>'.$order['userName'].'</td>
										<td>'.$order['userEmail'].'</td>
										<td>'.$order['userNo'].'</td>
										<td>'.$order['payStatus'].'</td>
										<td>'.$order['address'].','.$order['postal'].'&nbsp;'.$order['city'].','.$order['state'].'</td>
										<td>
											<div class="order-action-wrap">
												<form action="" method="POST">
													<button type="submit" class="btn-submit order-admin-page" 
													name="manage-order" value="'.$order['orderID'].'">
														<i class="fas fa-shipping-fast"></i>
													</button>
												</form>
												<form action="info.php" method="GET" target="_blank">
													<button type="submit" class="btn-submit order-admin-page" 
													name="item-detail" value="'.$order['orderID'].'">
														<i class="fas fa-info-circle"></i>
													</button>
												</form>
											</div>
										</td>
									</tr>
								';
							}

							echo '
								</table>
							';

						} else {

							echo '<h3 style="width:100%;">No new order found</h3>';

						}
	echo '
					</div>
				</div>
				<br><br>
				<div class="single-content order-admin">
					<div class="title-order-admin">
						<h2>Shipped Order</h2>
					</div>
					<div class="table-content-order">
	';
						//check have order or not
						if ($check2 > 0) {

							echo '
									<table border="1" class="order-admin-table">
										<tr>
											<th>Order ID</th>
											<th>Name</th>
											<th>Email</th>
											<th>Contact No</th>
											<th>Status</th>
											<th>Address</th>
											<th class="order-admin-action">Action</th>
										</tr>					
							';

							//fetch all shipped order detail
							while ($order2 = $result2->fetch_array()) {

								echo '
									<tr>
										<td>'.$order2['orderID'].'</td>
										<td>'.$order2['userName'].'</td>
										<td>'.$order2['userEmail'].'</td>
										<td>'.$order2['userNo'].'</td>
										<td>'.$order2['payStatus'].'</td>
										<td>
											'.$order2['address'].','.$order2['postal'].'&nbsp;'.$order2['city'].','.$order2['state'].'
										</td>
										<td>
											<div class="order-action-wrap">
												<form action="" method="POST">
													<button type="submit" class="btn-submit order-admin-page" 
													name="manage-order2" value="'.$order2['orderID'].'">
														<i class="fas fa-check-circle"></i>
													</button>
												</form>
												<form action="info.php" method="GET" target="_blank">
													<button type="submit" class="btn-submit order-admin-page" 
													name="item-detail" value="'.$order2['orderID'].'">
														<i class="fas fa-info-circle"></i>
													</button>
												</form>
											</div>
										</td>
									</tr>
								';
							}

							echo '
									</table>
							';

						} else {

							echo '<h3 style="width:100%;">No shipped order found</h3>';

						}
	echo '
					</div>
				</div>
				<br><br>
				<div class="single-content order-admin">
					<div class="title-order-admin">
						<h2>Completed Order</h2>
					</div>
					<div class="table-content-order">
	';
						//check have order or not
						if ($check3 > 0) {

							echo '
									<table border="1" class="order-admin-table">
										<tr>
											<th>Order ID</th>
											<th>Name</th>
											<th>Email</th>
											<th>Contact No</th>
											<th>Status</th>
											<th>Address</th>
											<th class="order-admin-action">Action</th>
										</tr>					
							';

							//fetch all completed order
							while ($order3 = $result3->fetch_array()) {

								echo '
									<tr>
										<td>'.$order3['orderID'].'</td>
										<td>'.$order3['userName'].'</td>
										<td>'.$order3['userEmail'].'</td>
										<td>'.$order3['userNo'].'</td>
										<td>'.$order3['payStatus'].'</td>
										<td>
											'.$order3['address'].','.$order3['postal'].'&nbsp;'.$order3['city'].','.$order3['state'].'
										</td>
										<td>
											<div class="order-action-wrap">
												<form action="info.php" method="GET" target="_blank">
													<button type="submit" class="btn-submit order-admin-page" 
													name="item-detail" value="'.$order3['orderID'].'">
														<i class="fas fa-info-circle"></i>
													</button>
												</form>
											</div>
										</td>
									</tr>
								';
							}

							echo '
									</table>
							';

						} else {

							echo '<h3 style="width:100%;">No completed order found</h3>';

						}
	echo '
					</div>
				</div>
				<br><br>
			</div>
		</div>
	';

	//close connection
	$connection->close();
?>