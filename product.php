<?php
	//call header
	include ('header.php');

	//add to cart fucntion
	//check addtocart form submission
	if (isset($_POST['addtocart'])) {

		//check user in session
		if (!empty($_SESSION['user'])) {
			
			//set userID from session
			$userID = $_SESSION['user'];

			//set value in variable
			$id = $_POST['addtocart'];
			$img = $_POST['img'];
			$name = $_POST['name'];
			$qty = $_POST['qty'];
			$price = $_POST['price'];

			//calculate total price for all item in cart
			$total_price = $price * $qty;

			//query insert item into cart
			$sql3 = "INSERT INTO he_cart(userID, itemID, itemImg, itemName, qty, price, status) 
			VALUES('$userID','$id','$img','$name','$qty','$total_price','UNPAID')";

			if ($connection->query($sql3) === TRUE) {

				//query insert item into temporary table
				$sql4 = "INSERT INTO he_order_item_temp(userID, itemID, itemName, price, qty) 
				VALUES('$userID','$id','$name', '$total_price', '$qty')";
				
				//give success message
				if ($connection->query($sql4) === TRUE) {
				
					echo'
				        <div class="overlay">
							<div class="popup">
								<a class="close" href="user/cart.php">&times;</a>
								<div class="content">
									<h2>Success</h2>
									<p>Item added to cart. Close this message to go to cart.</p>
								</div>
							</div>
						</div>
			        ';

		    	}

			}

		} else {

			//give error message for no user session
			echo'
		        <div class="overlay">
					<div class="popup">
						<a class="close" href="product.php?product-detail='.$_GET["product-detail"].'">&times;</a>
						<div class="content">
							<h2>Failed</h2>
							<p>Please login before purchasing item. <a class="return-login" href="account.php">Click here to login</a></p>
						</div>
					</div>
				</div>
	        ';

		}
	}

	echo '
		<div class="body-main">
			<div class="wrap">
				<br><br><br>
				<div class="single-content">
					<form action="" method="POST">
	';
						//get item detail function
						//check form submission from item choosen
						if (isset($_GET['product-detail'])) {
							
							//set item id from form submission
							$id = $_GET['product-detail'];

							//query select selected item
							$sql = "SELECT * FROM he_item WHERE itemID='$id'";
							$result = $connection->query($sql);
							$item = $result->fetch_array();

							//set value into variable
							$qty = $item["qty"];
							$category = $item["category"];
	echo '
							<div class="single-grid-left img-border">
								<img src="'.$item["itemImg"].'" width="500px" height="460px">
								<input type="hidden" name="img" value="'.$item["itemImg"].'">
							</div>
							<div class="single-grid-right">
								<h2>'.$item["itemName"].'</h2>
								<input type="hidden" name="name" value="'.$item["itemName"].'">
								<h3>RM'.$item["price"].'</h3>
								<input type="hidden" name="price" value="'.$item["price"].'">
								<hr>
								<br>
								<p class="product-description">'.$item["description"].'</p>
	';
							//check item stock
							if ($qty <= 0) {

								echo'
									<p><b>OUT OF STOCK</b></p>
									<hr>
									<br><br>
								';

							} else {

								echo'
									<p>IN STOCK : <b>'.$qty.'</b></p>
									<hr>
									<br><br>
									<input class="quantity" name="qty" type="number" min="1" max="'.$item['qty'].'" required>
									&nbsp;&nbsp;
									<button class="btn-addtocart" type="submit" name="addtocart" value="'.$item['itemID'].'">
										ADD TO CART
									</button>
								';

							}
	echo'
							</div>
	';
						} else {

							//give restriction if form submited by not proper way
							header('location:404.php');

						}
	echo '
					</form>
				</div>
				<br>
				<h1 class="content-title">Related Product</h1>
				<hr>
				<br><br><br>
				<div class="related-product">
					<form action="" method="GET">
	';
						//get item from same category
						$sql2 = "SELECT * FROM he_item WHERE category='$category' ORDER BY RAND() LIMIT 4";
						$result2 = $connection->query($sql2);

						//fetch all item detail
						while ($related = $result2->fetch_array()) {

							echo '
								<div class="catalog-gridx4">
									<button type="submit" class="btn-item-detail" name="product-detail" value="'.$related["itemID"].'">
										<img class="img-border" src="'.$related["itemImg"].'" width="250px" height="220px">
										<div class="item-info">
											<div class="item-name">'.$related["itemName"].'</div>
											<br>
											<div class="item-price">RM'.$related["price"].'</div>
										</div>
									</button>
								</div>
							';

						}
	echo'
					</form>
				</div>
				<br>
			</div>
		</div>
	';

?>