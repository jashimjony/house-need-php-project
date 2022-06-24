<?php
	//Item info for each order page start

	//fucntion get item for each order start

	//check form submission
	if (isset($_GET['item-detail'])) {

		//call header
		include ('header.php');

		//set orderID as variable
		$orderID = $_GET['item-detail'];

		//query to get detail order
		$sql = "SELECT * FROM he_order WHERE orderID='$orderID'";
		$result = $connection->query($sql);
		$order = $result->fetch_array();

		//display order
		echo '
			<div class="body-main">
				<div class="wrap">
					<h1 class="content-title">Detail</h1>
					<hr>
					<br><br>
					<div class="single-content receipt">
						<div class="grid-left">
							<div class="receipt-section">
								<h2>Billing Information</h2>
								<hr>
								<br>
								<h4>Order ID : '.$order['orderID'].'</h4>
								<h4>Full Name : '.$order['userName'].'</h4>
								<h4>Email : '.$order['userEmail'].'</h4>
								<h4>Contact No : '.$order['userNo'].'</h4>
								<h4>Payment Method : '.$order['payMethod'].'</h4>
								<h4>Payment Amount : RM'.$order['paymentAmount'].' <br> (Shipping Fees : RM5.00)</h4>
								<h4>Payment Status : '.$order['payStatus'].'</h4>
								<h4>Address : '.$order['address'].','.$order['postal'].'&nbsp;'.$order['city'].','.$order['state'].'</h4>
								<h4>Status : '.$order['status'].'</h4>
								<h4>Order Date : '.$order['orderDate'].'</h4>
							</div>
							<br>
                            <button onclick="closePrint()" class="print-btn">CLOSE</button>
						</div>
						<div class="grid-right">
							<div class="receipt-section">
								<h2>Item</h2>
								<hr>
								<br><br>
								<table border="1" class="receipt-table">
									<tr>
										<th>Item ID</th>
										<th>Name</th>
										<th>Quantity</th>
										<th>Price</th>
									</tr>
		';
									//query to get item for each order
									$sql2 = "SELECT * FROM he_order_item WHERE orderID='$orderID'";
									$result2 = $connection->query($sql2);

									//set default value for total price
									$sum_total_price = 0;

									//fetch all item detail for each order
									while ($item2 = $result2->fetch_array()) {

										$sum_total_price += $item2['price'];
										$total_item_price = number_format((float)$sum_total_price, 2, '.', '');

										echo '

											<tr>
												<td>'.$item2['itemID'].'</td>
												<td>'.$item2['itemName'].'</td>
												<td>'.$item2['qty'].'</td>
												<td>RM'.$item2['price'].'</td>
											</tr>

										';
									}
		echo '
									<tr>
										<td colspan="3" rowspan="2" style="background: #f1f1f1;"></td>
										<td>Total Price</td>
									</tr>
									<tr>
										<th>RM'.$total_item_price.'</th>
									</tr>
								</table>
							</div>
						</div>
					</div>
					<br><br>
				</div>
			</div>
			<script>
				function closePrint() {
                    window.close();
               	}
            </script>
		';

	} else {

		//restriction if form submitted by unproper way
		header('location:../404.php');

	}

	//close connection
	$connection->close();
?>