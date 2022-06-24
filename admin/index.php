<?php
	//Dashboard page admin panel start

	//call header
	include ('header.php');

	//query to get and count total item,order,user,feedback
	$sql = "SELECT * FROM he_item";
	$result = $connection->query($sql);
	$count = $result->num_rows;

	$sql2 = "SELECT * FROM he_order";
	$result2 = $connection->query($sql2);
	$count2 = $result2->num_rows;

	$sql3 = "SELECT * FROM he_user WHERE role='CUSTOMER'";
	$result3 = $connection->query($sql3);
	$count3 = $result3->num_rows;

	$sql4 = "SELECT * FROM he_feedback";
	$result4 = $connection->query($sql4);
	$count4 = $result4->num_rows;

	//display dashboard content
	echo '
		<div class="body-main body-admin">
			<div class="wrap">
				<h1 class="content-title">Dashboard</h1>
				<hr>
				<br><br><br>
				<div class="single-content dashboard">
					<div class="extra-wrap">
						<div class="grid-left">
							<i class="fas fa-box-open"></i>
							<h3>'.$count.'</h3>
							<br>
							<i class="fas fa-shopping-cart"></i>
							<h3>'.$count2.'</h3>
						</div>
						<div class="grid-right">
							<i class="fas fa-users"></i>
							<h3>'.$count3.'</h3>
							<br>
							<i class="fas fa-comment-dots"></i>
							<h3>'.$count4.'</h3>
						</div>
					</div>
				</div>
				<br><br>
				<div class="single-content dashboard">
					<div class="report-section">
						<h2>Sales Report Generator</h2>
						<hr>
						<br><br>
						<form action="report.php" method="POST">
							Start Date : <input type="date" name="start" min="2018-05-01" required>
                            &nbsp;&nbsp;
                            End Date : <input type="date" name="end" required>
                            <br><br>
                            <button type="submit" name="sale-report" class="btn-submit">Generate</button>
                            <button type="reset" class="btn-submit">Clear</button>
						</form>
					</div>
				</div>
				<br><br>
			</div>
		</div>
	';

	//close connection
	$connection->close();
?>