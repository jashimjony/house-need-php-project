<?php
	//call header
	include ('header.php');

	//query to get user cart
	$sql = "SELECT * FROM he_cart WHERE userID='$userID' AND status='UNPAID'";
	$result = $connection->query($sql);
	$check = $result->num_rows;

	//set default value for total price
	$sum_total_price = 0;

	//fucntion delete item from cart start
	if (isset($_POST['delete-cart'])) {
		
		//get item row id in cart
		$row_id = $_POST['delete-cart'];

		//delete item form cart
		$sql2 = "DELETE FROM he_cart WHERE row_id='$row_id'";

		if ($connection->query($sql2) === TRUE) {
			
			//delete item from temporary cart
			$sql3 = "DELETE FROM he_order_item_temp WHERE row_id='$row_id'";

			//show success message
			if ($connection->query($sql3) === TRUE) {
				
				echo'
				    <div class="overlay">
						<div class="popup">
							<a class="close" href="cart.php">&times;</a>
							<div class="content">
								<h2>Success</h2>
								<p>Item deleted from cart.</p>
							</div>
						</div>
					</div>
			    ';

			}
		} 
	}
	//function delete item in cart end

	//display cart
	echo '
		<div class="body-main">
			<div class="wrap">
				<h1 class="content-title">Cart</h1>
				<hr>
				<br><br>
				<div class="single-content cart">
	';
					//check have item in cart or not
					if ($check > 0) {

						echo '
							<form action="" method="POST">
								<table border="1" class="cart-table">
									<tr>
										<th>Image</th>
										<th>Name</th>
										<th>Quantity</th>
										<th>Price</th>
										<th>Remove</th>
									</tr>
						';

						//fetch all item in cart
						while ($cart = $result->fetch_array()) {

							$sum_total_price += $cart['price'];
							$total_cart_price = number_format((float)$sum_total_price, 2, '.', '');

							echo '
								<tr>
									<td><img src="../'.$cart['itemImg'].'" width="80px" height="80px"></td>
									<td>'.$cart['itemName'].'</td>
									<td>'.$cart['qty'].'</td>
									<td>RM'.$cart['price'].'</td>
									<td>
										<button type="submit" class="btn-submit cart-remove" name="delete-cart" value="'.$cart['row_id'].'">
											<i class="fas fa-trash-alt"></i>
										</button>
									</td>
								</tr>
								';
						}

						echo '
									<tr>
										<td colspan="4" rowspan="2" style="background: #f1f1f1;"></td>
										<td>Total Price</td>
									</tr>
									<tr>
										<th>RM'.$total_cart_price.'</th>
									</tr>
								</table>
								<br>
							</form>
							<form action="checkout.php" method="POST" class="form-checkout-btn">
								<button type="submit" class="btn-submit checkout" name="checkout">Checkout</button>
							</form>
						';

					} else {

						echo '<h3 style="text-align:center;width:100%;">No item in cart</h3>';

					}
	echo '
				</div>
				<br><br>
			</div>
		</div>
	';

	//call footer
	include ('footer.php');
?>