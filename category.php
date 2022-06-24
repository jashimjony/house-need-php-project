<?php
	//category fucntion

	//check category button submission
	if (isset($_GET['category'])) {

		//call header
		include ('header.php');

		//set category selected in variable
		$category = $_GET['category'];

		//select item from selected category
		$sql = "SELECT * FROM he_item WHERE category='$category'";
		$result = $connection->query($sql);

		//display item
		echo '
			<div class="body-main">
				<div class="wrap">
					<h1 class="content-title">'.$category.'</h1>
					<hr>
					<br><br><br>
					<div class="catalog-content">
						<form action="product.php" method="GET">
		';
							//fetch all item from selected category
							while ($item = $result->fetch_array()) {
								
								echo '
									<div class="catalog-gridx3">
										<button type="submit" class="btn-item-detail" name="product-detail" value="'.$item["itemID"].'">
										<img class="img-border" src="'.$item["itemImg"].'" width="320px" height="280px">
										<div class="item-info">
											<div class="item-name">'.$item["itemName"].'</div>
											<br>
											<div class="item-price">RM'.$item["price"].'</div>
										</div>
									</button>
									</div>
								';

							}
		echo '
						</form>
					</div>
				</div>
			</div>
		';

		//call footer
		include ('footer.php');

	} else if (isset($_GET['all'])) { //check button submission for all item

		//call header
		include ('header.php');

		//get all item
		$sql = "SELECT * FROM he_item";
		$result = $connection->query($sql);

		//display item
		echo '
			<div class="body-main">
				<div class="wrap">
					<h1 class="content-title">'.$_GET['all'].'</h1>
					<hr>
					<br><br><br>
					<div class="catalog-content">
						<form action="product.php" method="GET">
		';
							//fetch all item details
							while ($item = $result->fetch_array()) {
								
								echo '
									<div class="catalog-gridx3">
										<button type="submit" class="btn-item-detail" name="product-detail" value="'.$item["itemID"].'">
										<img class="img-border" src="'.$item["itemImg"].'" width="320px" height="280px">
										<div class="item-info">
											<div class="item-name">'.$item["itemName"].'</div>
											<br>
											<div class="item-price">RM'.$item["price"].'</div>
										</div>
									</button>
									</div>
								';

							}
		echo '
						</form>
					</div>
				</div>
			</div>
		';

		//call footer
		include ('footer.php');

	} else {

		//restriction for unproper form submission
		header('location:404.php');

	}
?>