<?php
	//call header
	include ('header.php');

	//query show random item for each category
	$sql = "SELECT itemID, itemName, itemImg, price FROM he_item WHERE category='Home Appliances' ORDER BY RAND() LIMIT 3";
    $result = $connection->query($sql);

    //query show random item for each category
	$sql2 = "SELECT itemID, itemName, itemImg, price FROM he_item WHERE category='Kitchen Appliances' ORDER BY RAND() LIMIT 3";
    $result2 = $connection->query($sql2);

	//query show random item for each category
	$sql3 = "SELECT itemID, itemName, itemImg, price FROM he_item WHERE category='Digital' ORDER BY RAND() LIMIT 3";
    $result3 = $connection->query($sql3);

	echo '
		<div class="body-main">
			<div class="wrap">
				<h1 class="content-title">Featured Product</h1>
				<hr>
				<br><br><br>
				<div class="catalog-content">
					<form action="product.php" method="GET">
	';
						//fetch all item detail for category home appliances
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

						//fetch all item detail for category kitchen appliances
						while ($item2 = $result2->fetch_array()) {

							echo '
								<div class="catalog-gridx3">
									<button type="submit" class="btn-item-detail" name="product-detail" value="'.$item2["itemID"].'">
										<img class="img-border" src="'.$item2["itemImg"].'" width="320px" height="280px">
										<div class="item-info">
											<div class="item-name">'.$item2["itemName"].'</div>
											<br>
											<div class="item-price">RM'.$item2["price"].'</div>
										</div>
									</button>
								</div>
							';
						}

						//fetch all item detail for category digital
						while ($item3 = $result3->fetch_array()) {

							echo '
								<div class="catalog-gridx3">
									<button type="submit" class="btn-item-detail" name="product-detail" value="'.$item3["itemID"].'">
										<img class="img-border" src="'.$item3["itemImg"].'" width="320px" height="280px">
										<div class="item-info">
											<div class="item-name">'.$item3["itemName"].'</div>
											<br>
											<div class="item-price">RM'.$item3["price"].'</div>
										</div>
									</button>
								</div>
							';
						}

	echo'
					</form>
				</div>
			</div>
		</div>
	';

?>