<?php
	//receipt page start
	
	//fucntion receipt start
	//check receipt order from form submission
	if (isset($_GET['detail'])) {

		//call header
		include ('header.php');

		//set orderID in variable
		$orderID = $_GET['detail'];

		//get order detail
		$sql = "SELECT * FROM he_order WHERE orderID='$orderID'";
		$result = $connection->query($sql);
		$order = $result->fetch_array();

		//display receipt
		echo '
			<div class="body-main">
				<div class="wrap">
					<h1 class="content-title">Receipt</h1>
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
							<button onclick="openPrint()" class="print-btn" style="margin-right:10px;">PRINT</button>
                            <button onclick="closePrint()" class="print-btn">CLOSE</button>
						</div>
						<div class="grid-right">
							<div class="receipt-section">
								<h2>Item</h2>
								<hr>
								<br><br>
								<table border="1" class="receipt-table">
									<tr>
										<th>Image</th>
										<th>Name</th>
										<th>Quantity</th>
										<th>Price</th>
									</tr>
		';
									$sql2 = "SELECT * FROM he_order_item WHERE orderID='$orderID'";
									$result2 = $connection->query($sql2);

									$sum_total_price = 0;

									while ($item2 = $result2->fetch_array()) {

										$sql3 = "SELECT * FROM he_item WHERE itemID='".$item2['itemID']."'";
										$result3 = $connection->query($sql3);

										$sum_total_price += $item2['price'];
										$total_item_price = number_format((float)$sum_total_price, 2, '.', '');

										echo '

											<tr>
												<td>

										';

										while ($image = $result3->fetch_array()) {

											echo '

												<img src="../'.$image['itemImg'].'" width="80px" height="80px">

											';

										}

										echo '
												</td>
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
		';
		//function receipt end

		//call footer
		include ('footer.php');

	} else {

		//restriction if receipt form submitted by unproper way
		header('location:../404.php');

	}
?>