<?php
	//call header
	include ('header.php');

	//search function
	//check search form submission
	if(isset($_GET["search"])) {

		//combining keyword function
 		$condition = '';  
 		$query = explode(" ", $_GET["search"]);

        foreach($query as $text) {

        	$condition .= "itemName LIKE '%".mysqli_real_escape_string($connection, $text)."%' OR ";
        }  

		$condition = substr($condition, 0, -4);

		//get item based on value from text form
		$sql = "SELECT * FROM he_item WHERE " . $condition;
		$result = $connection->query($sql);
		$check = $result->num_rows;

		//check if the keyword exist for some item or not
		if ($check > 0) {

			echo '
				<div class="body-main">
					<div class="wrap">
						<h1 class="content-title">Search For Keyword "'.$_GET["search"].'"</h1>
						<hr>
						<br><br><br>
						<div class="catalog-content">
							<form action="product.php" method="GET">
			';
								//fetch all the item search by user
								while ($search = $result->fetch_array()) {

									echo'
									<div class="catalog-gridx3">
										<button type="submit" class="btn-item-detail" name="product-detail" value="'.$search["itemID"].'">
												<img src="'.$search["itemImg"].'" width="320px" height="280px">
												<div class="item-info">
													<div class="item-name">'.$search["itemName"].'</div>
													<br>
													<div class="item-price">RM'.$search["price"].'</div>
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

		} else {

			//give message for result not found
			echo '
				<div class="body-main">
					<div class="wrap">
						<h1 class="content-title">Search For Keyword &nbsp "'.$_GET["search"].'"</h1>
						<hr>
						<br><br><br>
						<div class="catalog-content">
							<h3 style="text-align:center;width:100%;">No result found for "'.$_GET["search"].'"
							<br><br>
						</div>
					</div>
				</div>
			';

		}

	} else {

		//restriction if search form submitted by unproper way
		header('location:404.php');

	}

?>