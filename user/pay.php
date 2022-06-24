<?php
	//Payment page start

	//call header
	include ('header.php');

	//query to get user cart
	$sql = "SELECT * FROM he_cart WHERE userID='$userID' AND status='UNPAID'";
	$result = $connection->query($sql);

	$sum_total_price = 0;

	//calculate total payment need to pay
	while ($item = $result->fetch_array()) {

		$sum_total_price += $item['price'];

	}

	//add shipping fees
	$total_item_price = $sum_total_price + 5;
	//round off total payment into 2 decimal places
	$total_payment = number_format((float)$total_item_price, 2, '.', '');

	//payment function start
	if (isset($_POST['pay2'])) {

		$fullname = $_POST['fullname'];
		$email = $_POST['email'];
		$contact = $_POST['contact'];
		$amount = $_POST['amount'];
		$pay_method = $_POST['pay-method'];
		$shipping = $_POST['shipping'];
		$address = $connection->real_escape_string($_POST['address']);
		$city = $_POST['city'];
		$postal = $_POST['postal'];
		$state = $_POST['state'];
			
		$sql2 = "INSERT INTO 
		he_order(userID, userName, userEmail, userNo, paymentAmount, payMethod, payStatus, address, city, postal, state, status) 
		VALUES 
		('$userID','$fullname','$email','$contact','$amount','$pay_method', 'PAID', '$address','$city','$postal','$state','PROCESSING')";
		$connection->query($sql2);
				
		$sql3 = "SELECT orderID FROM he_order WHERE userID='$userID'";
		$result3 = $connection->query($sql3);

		while ($order3 = $result3->fetch_array()) {

    		$orderID = $order3['orderID'];

    		$sql4 = "UPDATE he_order_item_temp SET orderID='$orderID' WHERE userID='$userID'";
    		$connection->query($sql4);

        }

		$sql5 = "SELECT * FROM he_order_item_temp WHERE userID='$userID'";
		$result5 = $connection->query($sql5);

		while ($order5 = $result5->fetch_array()) {

			$orderID = $order5['orderID'];
			$itemID = $order5['itemID'];
			$itemName = $order5['itemName'];
			$price = $order5['price'];
			$qty = $order5['qty'];
			$date = $order5['orderDate'];

			$sql6 = "INSERT INTO he_order_item(orderID, userID, itemID, itemName, price, qty, orderDate)
			VALUES ('$orderID', '$userID', '$itemID','$itemName','$price','$qty','$date')";
			$connection->query($sql6);

			$sql7 = "SELECT * FROM he_item WHERE itemID='$itemID'";
			$result7 = $connection->query($sql7);

			while ($check_qty = $result7->fetch_array()) {
					
				$itemID2 = $check_qty['itemID'];
				$qty2 = $check_qty['qty'];

				$cal_stock = $qty2 - $qty;
				$result_qty = $cal_stock;

				$sql8 = "UPDATE he_item SET qty='$result_qty' WHERE itemID='$itemID2'";
				$connection->query($sql8);
						
				$sql9 = "SELECT qty FROM he_item WHERE itemID='$itemID2'";
				$result9 = $connection->query($sql9);

				while ($check_qty2 = $result9->fetch_array()) {
							
					$qty3 = $check_qty2['qty'];

					if ($qty3 <= 0) {
								
						$sql10 = "UPDATE he_item SET status='OUT OF STOCK' WHERE itemID='$itemID2'";
						$connection->query($sql10);

					}

				}

			}

		}

		$sql11 = "DELETE FROM he_order_item_temp WHERE userID='$userID'";
		$connection->query($sql11);

		$sql12 = "DELETE FROM he_cart WHERE userID='$userID'";

		//give payment success message and show feedback form
		if ($connection->query($sql12) === TRUE) {

			echo'
				<div class="overlay">
					<div class="popup">
						<a class="close" href="order.php">&times;</a>
						<div class="content">
							<h2>Payment Success</h2>
							<p>Thank you for choosing us. Close this message to see your order detail.</p>
							<h2>Please give us some feedback</h2>
							<form action="order.php" method="POST">
								<h4>How satisfied you are?</h4>
								1<input type="radio" name="rate" value="1">
								2<input type="radio" name="rate" value="2">
								3<input type="radio" name="rate" value="3">
								4<input type="radio" name="rate" value="4">
								5<input type="radio" name="rate" value="5">
								<h4>Your Feedback</h4>
								<textarea rows="3" cols="50" name="message" required></textarea>
								<br>
								<button class="btn-submit" type="submit" name="feedback">Submit</button>
							</form>
						</div>
					</div>
				</div>
			';

		}
		//payment function end
		
	}

		echo '
			<div class="body-main">
				<div class="wrap">
					<h1 class="content-title"><i class="fas fa-lock"></i>&nbsp;Secure Payment</h1>
					<hr>
					<br><br>
					<div class="single-content payment">
						<form action="" method="POST">
							<h2>Card Details</h2>
							<hr>
							<br>
							<h4>Total Payment : RM'.$total_payment.'<br>(Included Shipping Fees RM5.00)</h4>
							<input type="text" name="owner" placeholder="Owner&apos;s Name" required>
							<br><br>
							<input type="text" name="card" placeholder="Card Number" required>
							<br><br>
							<input class="exp-mm" type="text" name="expire-mm" placeholder="MM" required>
							/
							<input class="exp-yy" type="text" name="expire-yy" placeholder="YYYY" required>
							<br><br>
							<input class="cvvno" type="text" name="cvv" placeholder="CVV" required>
							<br><br>
							<button class="btn-submit" type="submit" name="pay2">Submit</button>
							<a href="cart.php"><p>Cancel</p></a>
							<input type="hidden" name="fullname" value="'.$_POST['fullname'].'">
                            <input type="hidden" name="email" value="'.$_POST['email'].'">
                            <input type="hidden" name="contact" value="'.$_POST['contact'].'">
                            <input type="hidden" name="amount" value="'.$total_payment.'">
                            <input type="hidden" name="pay-method" value="'.$_POST['pay-method'].'">
                            <input type="hidden" name="shipping" value="'.$_POST['shipping'].'">
                            <input type="hidden" name="address" value="'.$_POST['address'].'">
                            <input type="hidden" name="city" value="'.$_POST['city'].'">
                            <input type="hidden" name="postal" value="'.$_POST['postal'].'">
                            <input type="hidden" name="state" value="'.$_POST['state'].'">  
						</form>
					</div>
					<br><br>
				</div>
			</div>
		';

	include ('footer.php');
?>