<?php
	//Item page admin panel start

	//call header
	include ('header.php');

	//query to get item
	$sql = "SELECT * FROM he_item WHERE status='IN STOCK'";
	$result = $connection->query($sql);
	$check = $result->num_rows;

	$sql2 = "SELECT * FROM he_item WHERE status='OUT OF STOCK'";
	$result2 = $connection->query($sql2);
	$check2 = $result2->num_rows;

	//function add new item start

	//check form submission to open form to add new item
	if (isset($_POST['open-new-form'])) {

		//display item
		echo'
			<div class="overlay overlay-edit">
				<div class="popup item">
					<a class="close" href="item.php">&times;</a>
					<div class="content">
						<h2>Add New Item</h2>
						<form action="item.php" method="POST" enctype="multipart/form-data">
							<div class="grid-full">
								<p class="upload-pic-title">Upload Image : </p>
								<input type="file" class="upload-file-pic" name="image" required>
							</div>
							<div class="grid-left">
								<h4>Name :</h4>
								<input type="text" name="name" reuqired>
								<h4>Quantity :</h4>
								<input type="text" name="qty" required>
								<h4>Status :</h4>
								<select name="status" required>
									<option value="" selected disabled>Select Status</option>
									<option value="IN STOCK">IN STOCK</option>
									<option value="OUT OF STOCK">OUT OF STOCK</option>
								</select>
							</div>
							<div class="grid-right">
								<h4>Price :</h4>
								<input type="text" name="price" required>
								<h4>Category :</h4>
								<select name="category" required>
									<option value="" selected disabled>Select Category</option>
									<option value="Home Appliances">Home Appliances</option>
									<option value="Kitchen Appliances">Kitchen Appliances</option>
									<option value="Digital">Digital</option>
								</select>
								<h4>Description :</h4>
								<textarea rows="5" cols="42" name="desc" required></textarea>
							</div>
							<br><br>
							<div class="grid-full">
								<button type="submit" class="btn-submit save-item-page" name="add-new-item">
									Save
								</button>
							</div>
						</form>
					</div>
				</div>
			</div>
		';

	}

	//check form submission to add new item
	if (isset($_POST['add-new-item'])) {
		
		//set value in variable
		$name = $_POST['name'];
		$qty = $_POST['qty'];
		$status = $_POST['status'];
		$price = $_POST['price'];
		$category = $_POST['category'];
		$desc = $connection->real_escape_string($_POST['desc']);

		//function to get image extension
        function GetImageExtension($imgtype) {

            if(empty($imgtype)) return false;

            switch($imgtype) {

                case 'image/JPEG': return '.JPG';
                case 'image/jpeg': return '.jpg';
                case 'image/JPG': return '.JPG';
                case 'image/jpg': return '.jpg';
                case 'image/JPEG': return '.JPEG';
                case 'image/jpeg': return '.jpeg';
                case 'image/PNG': return '.PNG';
                case 'image/png': return '.png';
                default: return false;

            }
        }

        //set img detail in variable
        $file_name = $_FILES["image"]["name"];
        $temp_name= $_FILES["image"]["tmp_name"];
        $imgsize = $_FILES["image"]["size"];
        $imgtype = $_FILES["image"]["type"];
        $ext = GetImageExtension($imgtype);

        //set img name
        $imagename = $file_name;

        //set target to store image
        $target_path = '../images/'.$imagename.'';

        //set text link to store in database
        $link = 'images/'.$imagename.'';

        //check img size
        if ($imgsize > 3145728) {

            //return error - image size too big
            echo'
				<div class="overlay overlay-edit">
					<div class="popup item2">
						<a class="close" href="item.php">&times;</a>
						<div class="content">
							<h2>Failed</h2>
							<p>Image size more than 3MB.</p>
						</div>
					</div>
				</div>
			';

        } elseif (($imgtype != "image/JPEG") && ($imgtype != "image/jpeg") && ($imgtype != "image/JPG") && ($imgtype != "image/jpg") 
            		&& ($imgtype != "image/PNG") && ($imgtype != "image/png")) {

            //return error - invalid img extension
            echo'
				<div class="overlay overlay-edit">
					<div class="popup item2">
						<a class="close" href="item.php">&times;</a>
						<div class="content">
							<h2>Failed</h2>
							<p>Only JPG, JPEG & PNG, files are allowed.</p>
						</div>
					</div>
				</div>
			';

        } else {
        	//move image to targeted folder
            while (move_uploaded_file($temp_name, $target_path)) {
				
				//insert new item into database
				$sql3 = "INSERT INTO he_item(itemName, itemImg, price, qty, status, category, description)
				VALUES ('$name', '$link', '$price', '$qty', '$status', '$category', '$desc')";

				//give success message
				if ($connection->query($sql3) === TRUE) {
						
					echo'
						<div class="overlay overlay-edit">
							<div class="popup item2">
								<a class="close" href="item.php">&times;</a>
								<div class="content">
									<h2>Success</h2>
									<p>New Item Added.</p>
								</div>
							</div>
						</div>
					';

				}
			}
		}
	}

	//function add new item end

	//function edit current item start

	//check form submission to edit current item
	if (isset($_POST['edit-item'])) {
		
		//set itemID in variable
		$itemID = $_POST['edit-item'];

		//get item detail
		$sql4 = "SELECT * FROM he_item WHERE itemID='$itemID'";
		$result4 = $connection->query($sql4);
		$edit = $result4->fetch_array();

		//display item
		echo'
			<div class="overlay overlay-edit">
				<div class="popup item">
					<a class="close" href="item.php">&times;</a>
					<div class="content">
						<h2>Edit Item - '.$itemID.'</h2>
						<form action="item.php" method="POST" enctype="multipart/form-data">
							<div class="grid-full">
								<p class="upload-pic-title">Upload New Picture : </p>
								<input type="file" class="upload-file-pic" name="image">
							</div>
							<div class="grid-left">
								<h4>Name :</h4>
								<input type="text" name="name" value="'.$edit['itemName'].'">
								<h4>Quantity :</h4>
								<input type="text" name="qty" value="'.$edit['qty'].'">
								<h4>Status :</h4>
								<select name="status" required>
									<option value="'.$edit['status'].'" selected>'.$edit['status'].'</option>
									<option value="IN STOCK">IN STOCK</option>
									<option value="OUT OF STOCK">OUT OF STOCK</option>
								</select>
							</div>
							<div class="grid-right">
								<h4>Price :</h4>
								<input type="text" name="price" value="'.$edit['price'].'">
								<h4>Category :</h4>
								<select name="category" required>
									<option value="'.$edit['category'].'" selected>'.$edit['category'].'</option>
									<option value="Home Appliances">Home Appliances</option>
									<option value="Kitchen Appliances">Kitchen Appliances</option>
									<option value="Digital">Digital</option>
								</select>
								<h4>Description :</h4>
								<textarea rows="5" cols="42" name="desc" required>'.$edit['description'].'</textarea>
							</div>
							<br><br>
							<div class="grid-full">
								<button type="submit" class="btn-submit save-item-page" name="save-item" value="'.$itemID.'">
									Save
								</button>
							</div>
						</form>
					</div>
				</div>
			</div>
		';
	}

	//check form submission to save item
	if (isset($_POST['save-item'])) {
		
		//set value in variable
		$itemID = $_POST['save-item'];
		$name = $_POST['name'];
		$qty = $_POST['qty'];
		$status = $_POST['status'];
		$price = $_POST['price'];
		$category = $_POST['category'];
		$desc = $connection->real_escape_string($_POST['desc']);

		//function get image extension
        function GetImageExtension($imgtype) {

            if(empty($imgtype)) return false;

            switch($imgtype) {

                case 'image/JPEG': return '.JPG';
                case 'image/jpeg': return '.jpg';
                case 'image/JPG': return '.JPG';
                case 'image/jpg': return '.jpg';
                case 'image/JPEG': return '.JPEG';
                case 'image/jpeg': return '.jpeg';
                case 'image/PNG': return '.PNG';
                case 'image/png': return '.png';
                default: return false;

            }
        }

        //check image selected or not
        if (!empty($_FILES["image"]["name"])) {

	        //set img detail
	        $file_name = $_FILES["image"]["name"];
	        $temp_name= $_FILES["image"]["tmp_name"];
	        $imgsize = $_FILES["image"]["size"];
	        $imgtype = $_FILES["image"]["type"];
	        $ext = GetImageExtension($imgtype);

	        //set img name
	        $imagename = $file_name;

	        //set target to store image
	        $target_path = '../images/'.$imagename.'';

	        //set text link to store in database
	        $link = 'images/'.$imagename.'';

	        //check img size
	        if ($imgsize > 3145728) {

	            //return error - image size too big
	            echo'
					<div class="overlay overlay-edit">
						<div class="popup item2">
							<a class="close" href="item.php">&times;</a>
							<div class="content">
								<h2>Failed</h2>
								<p>Image size more than 3MB.</p>
							</div>
						</div>
					</div>
				';

	        } elseif (($imgtype != "image/JPEG") && ($imgtype != "image/jpeg") && ($imgtype != "image/JPG") && ($imgtype != "image/jpg") 
	            		&& ($imgtype != "image/PNG") && ($imgtype != "image/png")) {

	            //return error - invalid img extension
	            echo'
					<div class="overlay overlay-edit">
						<div class="popup item2">
							<a class="close" href="item.php">&times;</a>
							<div class="content">
								<h2>Failed</h2>
								<p>Only JPG, JPEG & PNG, files are allowed.</p>
							</div>
						</div>
					</div>
				';

	        } else {

	        	//move new image to targeted folder
	            while (move_uploaded_file($temp_name, $target_path)) {
					
					//update detail for current item with image selected
					$sql5 = "UPDATE he_item 
					SET itemName='$name', itemImg='$link', price='$price', qty='$qty', 
					status='$status', category='$category', description='$desc'
					WHERE itemID='$itemID'";

					//give success message
					if ($connection->query($sql5) === TRUE) {
							
						echo'
							<div class="overlay overlay-edit">
								<div class="popup item2">
									<a class="close" href="item.php">&times;</a>
									<div class="content">
										<h2>Success</h2>
										<p>Item saved.</p>
									</div>
								</div>
							</div>
						';

					}
				}
			}
		
		} else {
			//update detail for current item without image selected
			$sql6 = "UPDATE he_item 
			SET itemName='$name', price='$price', qty='$qty', status='$status', category='$category', description='$desc'
			WHERE itemID='$itemID'";

			//give success message
			if ($connection->query($sql6) === TRUE) {
					
				echo'
					<div class="overlay overlay-edit">
						<div class="popup item2">
							<a class="close" href="item.php">&times;</a>
							<div class="content">
								<h2>Success</h2>
								<p>Item saved.</p>
							</div>
						</div>
					</div>
				';

			}
		}
	}

	//function edit current item end

	//function delete item start
	if (isset($_POST['delete-item'])) {
		
		//set itemID in variable
		$itemID = $_POST['delete-item'];

		//query delete item
		$sql5 = "DELETE FROM he_item WHERE itemID='$itemID'";

		//give success message
		if ($connection->query($sql5) === TRUE) {
				
			echo'
				<div class="overlay overlay-edit">
					<div class="popup">
						<a class="close" href="item.php">&times;</a>
						<div class="content">
							<h2>Success</h2>
							<p>Item deleted.</p>
						</div>
					</div>
				</div>
			';

		}

	}

	//display item
	echo '
		<div class="body-main body-admin">
			<div class="wrap">
				<h1 class="content-title">Item</h1>
				<hr>
				<br><br>
				<div class="single-content item">
					<form action="" method="POST" class="addnewitem-section">
						<button type="submit" class="btn-submit save-item-page" name="open-new-form">
							Add New Item
						</button>
					</form>
				</div>
				<div class="single-content item">
					<form action="" method="POST">
						<h2>IN STOCK</h2>
	';
					//check have item or not
					if ($check > 0) {

						echo '
								<table border="1" class="item-table">
									<tr>
										<th>ID</th>
										<th>Image</th>
										<th>Name</th>
										<th>Quantity</th>
										<th>Status</th>
										<th>Price</th>
										<th>Category</th>
										<th>Description</th>
										<th class="item-action">Action</th>
									</tr>
						';

						//fetch all item detail
						while ($item = $result->fetch_array()) {

							echo '
								<tr>
									<td>'.$item['itemID'].'</td>
									<td><img src="../'.$item['itemImg'].'" width="80px" height="80px"></td>
									<td>'.$item['itemName'].'</td>
									<td>'.$item['qty'].'</td>
									<td>'.$item['status'].'</td>
									<td>RM'.$item['price'].'</td>
									<td>'.$item['category'].'</td>
									<td>'.$item['description'].'</td>
									<td>
										<div class="item-action-wrap">
										<button type="submit" class="btn-submit item-page" name="edit-item" value="'.$item['itemID'].'">
											<i class="fas fa-edit"></i>
										</button>
										<button type="submit" class="btn-submit item-page" name="delete-item" value="'.$item['itemID'].'">
											<i class="fas fa-trash-alt"></i>
										</button>
										</div>
									</td>
								</tr>
								';
						}

						echo '
								</table>
						';

					} else {

						echo '<h3 style="width:100%;">No product found</h3>';

					}
	echo '
					</form>
				</div>
				<br><br>
				<div class="single-content item">
					<form action="" method="POST">
						<h2>OUT OF STOCK</h2>
	';
					//check have item or not
					if ($check2 > 0) {

						echo '
								<table border="1" class="item-table">
									<tr>
										<th>ID</th>
										<th>Image</th>
										<th>Name</th>
										<th>Quantity</th>
										<th>Status</th>
										<th>Price</th>
										<th>Category</th>
										<th>Description</th>
										<th class="item-action">Action</th>
									</tr>
						';

						//fetch all item detail
						while ($item2 = $result2->fetch_array()) {

							echo '
								<tr>
									<td>'.$item2['itemID'].'</td>
									<td><img src="../'.$item2['itemImg'].'" width="80px" height="80px"></td>
									<td>'.$item2['itemName'].'</td>
									<td>'.$item2['qty'].'</td>
									<td>'.$item2['status'].'</td>
									<td>RM'.$item2['price'].'</td>
									<td>'.$item2['category'].'</td>
									<td>'.$item2['description'].'</td>
									<td>
										<div class="item-action-wrap">
										<button type="submit" class="btn-submit item-page" name="edit-item" value="'.$item2['itemID'].'">
											<i class="fas fa-edit"></i>
										</button>
										<button type="submit" class="btn-submit item-page" name="delete-item" value="'.$item2['itemID'].'">
											<i class="fas fa-trash-alt"></i>
										</button>
										</div>
									</td>
								</tr>
								';
						}

						echo '
								</table>
						';

					} else {

						echo '<h3 style="width:100%;">No product found</h3>';

					}
	echo '
					</form>
				</div>
				<br><br>
			</div>
		</div>
	';

	//close connection
	$connection->close();
?>