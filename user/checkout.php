<?php
	//Checkout page start

	//call header
	include ('header.php');

	//function checkout start

	//check checkout form submission
	if (isset($_POST['checkout'])) {

		//get user detail
		$sql = "SELECT * FROM he_user WHERE userID='$userID'";
		$result = $connection->query($sql);
		$data = $result->fetch_array();

		//dispplay billing form
		echo '
			<div class="body-main">
				<div class="wrap">
					<h1 class="content-title">Checkout</h1>
					<hr>
					<br><br>
					<div class="single-content checkout">
						<div class="grid-left">
							<form action="pay.php" method="POST">
								<h2>Billing Information</h2>
								<hr>
								<br>
								<h4>Full Name</h4>
								<input type="text" name="fullname" value="'.$data['userName'].'" required>
								<h4>Email</h4>
								<input type="email" value="'.$data['userEmail'].'" required disabled>
								<input type="hidden" name="email" value="'.$data['userEmail'].'">
								<h4>Contact No</h4>
								<input type="text" name="contact" value="'.$data['userNo'].'" required>
								<h4>Payment Method</h4>
		                        <input class="checkout-radio" type="radio" name="pay-method" value="debit" checked>
		                        	<i class="fas fa-credit-card"></i>&nbsp;Debit Card
		                        <h4>Shipping</h4>
		                        <input class="checkout-radio" type="radio" name="shipping" value="Standard Shipping" checked>
		                        	Standard&nbsp;&nbsp;(Work with 3-14 days | Fees : RM 5.00)
								<h4>Address 1</h4>
		                        <input type="text" name="address" required>
		                        <h4>City</h4>
		                        <input type="text" name="city" required>
		                        <h4>Postal Code</h4>
		                        <input type="text" name="postal" required>
		                        <h4>State</h4>
		                        <select name="state" required>
		                            <option value="" selected disabled>Choose State</option>
		                            <option value="JOHOR">Johor</option>
		                            <option value="MELAKA">Melaka</option>
		                            <option value="NEGERI SEMBILAN">Negeri Sembilan</option>
		                            <option value="SELANGOR">Selangor</option>
		                            <option value="KUALA LUMPUR">Kuala Lumpur</option>
		                            <option value="PUTRAJAYA">Putrajaya</option>
		                            <option value="PAHANG">Pahang</option>
		                            <option value="TERENGGANU">Terengganu</option>
		                            <option value="PERAK">Perak</option>
		                            <option value="KELANTAN">Kelantan</option>
		                            <option value="KEDAH">Kedah</option>
		                            <option value="PERLIS">Perlis</option>
		                            <option value="PULAU PINANG">Pulau Pinang</option>
		                            <option value="SABAH">Sabah</option>
		                            <option value="SARAWAK">Sarawak</option>
		                        </select>
								<br><br><br>
								<button class="btn-submit" type="submit" name="pay" value="'.$userID.'">Pay</button>
								<a href="cart.php"><p>Cancel</p></a>
							</form>
						</div>
						<div class="grid-right">
							<form action="" method="">
								<h2>Item</h2>
								<hr>
								<br><br>
								<table border="1" class="checkout-table">
									<tr>
										<th>Image</th>
										<th>Name</th>
										<th>Quantity</th>
										<th>Price</th>
									</tr>
		';
									//get and fetch item purchase
									$sql2 = "SELECT * FROM he_cart WHERE userID='$userID' AND status='UNPAID'";
									$result2 = $connection->query($sql2);

									$sum_total_price = 0;

									while ($item2 = $result2->fetch_array()) {

										$sum_total_price += $item2['price'];
										$total_item_price = number_format((float)$sum_total_price, 2, '.', '');

										echo '
											<tr>
												<td><img src="../'.$item2['itemImg'].'" width="80px" height="80px"></td>
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
							</form>
						</div>
					</div>
					<br><br>
				</div>
			</div>
		';

	} else {

		//restriction if checkout form submitted by unproper way
		header('location:../404.php');

	}
	//function checkout end

	//call footer
	include ('footer.php');
?>