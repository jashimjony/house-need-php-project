<?php
	//customer detail page start

	//call header
	include ('header.php');

	//query to get customer detail
	$sql = "SELECT * FROM he_user WHERE role='CUSTOMER'";
	$result = $connection->query($sql);
	$check = $result->num_rows;

	//display customer detail content
	echo '
		<div class="body-main body-admin">
			<div class="wrap">
				<h1 class="content-title">Customer</h1>
				<hr>
				<br><br>
				<div class="single-content customer">
					<div class="title-customer">
						<h2>Customer List</h2>
					</div>
					<div class="table-content-customer">
	';
						//check have data customer or not
						if ($check > 0) {

							echo '
								<table border="1" class="customer-table">
									<tr>
										<th>User ID</th>
										<th>Name</th>
										<th>Email</th>
										<th>Contact No</th>
										<th>Gender</th>
									</tr>
							';

							//fetch all customer data
							while ($cust = $result->fetch_array()) {

								echo '
									<tr>
										<td>'.$cust['userID'].'</td>
										<td>'.$cust['userName'].'</td>
										<td>'.$cust['userEmail'].'</td>
										<td>'.$cust['userNo'].'</td>
										<td>'.$cust['userGender'].'</td>
									</tr>
								';
							}

							echo '
								</table>
							';

						} else {

							echo '<h3 style="width:100%;">No customer found</h3>';

						}
	echo '
					</div>
				</div>
			</div>
		</div>
	';

	//customer detail page end

	//close connection
	$connection->close();
?>