<?php
   //function generate report start

   //get database connection
   require ('../config.php');

   //check form submission
   if (isset($_POST['sale-report'])) {

      //set input date from form
      $start_date = $_POST['start'];
      $end_date = $_POST['end'];

      //get data form database
      $sql5 = "SELECT YEAR(orderDate) as 'Year', MONTHNAME(orderDate) as 'Month', sum(paymentAmount) as 'Sale', count(*) as 'Order' FROM he_order WHERE orderDate BETWEEN '$start_date' AND '$end_date' GROUP BY MONTH(orderDate)";
      $result5 = $connection->query($sql5);
      $check = $result5->num_rows;

      //set default value to 0
      $cal_total_order_monthly = 0;
      $cal_total_sale_monthly = 0;

      //check data found or not
      if ($check >= 1) {

         //set excel's file name
         $filename = 'Report - Sales Overtime ('.$start_date.' to '.$end_date.')';

         //define file extension
         header('Content-type:  application/vnd.ms-excel');

         //set the name of file that will downloaded
         header('Content-Disposition: attachment;Filename='.$filename.'.xls');

         //set cache control and expires
         header('Pragma: no-cache'); 
         header('Expires: 0');

         //start create table template
         $table = '

            <table border="1" style="width:40%;">
               <caption>'.$filename.'</caption>
               <thead>
                  <tr>
                     <th bgcolor="FFFF00">Month</th>
                     <th bgcolor="FFFF00">Year</th>
                     <th bgcolor="FFFF00">Order</th>
                     <th bgcolor="FFFF00">Sale</th>
                  </tr>
               </thead>
               <tbody>
         ';
               
               //fetch all requirement data in table
               while($data = $result5->fetch_array()){

                  //set the requirement data
                  $year = $data['Year'];
                  $month = $data['Month'];
                  $order = $data['Order'];
                  $sale = $data['Sale'];

                  //calculate total order for the selected month
                  $cal_total_order_monthly += $order;
                  $total_order_monthly = $cal_total_order_monthly;

                  //calculate total sale for the selected month
                  $cal_total_sale_monthly += $sale;
                  $res_total_sale_monthly = $cal_total_sale_monthly;
                  $total_sale_monthly = number_format((float)$res_total_sale_monthly, 2, '.', '');

                  $table .= '
                     <tr>
                        <td style="text-align:center;">'.$month.'</td>
                        <td style="text-align:center;">'.$year.'</td>
                        <td style="text-align:center;">'.$order.'</td>
                        <td style="text-align:center;">RM&nbsp;'.$sale.'</td>
                     </tr>
                  ';

               }

         $table .= '
		               <tr>
                        <td colspan="2" bgcolor="#9E9E9E"></td>
                        <td bgcolor="#FFFF00" style="text-align:center;"><b>Total Order</b></td>
                        <td bgcolor="#FFFF00" style="text-align:center;"><b>Total Sale</b></td>
                     </tr>
                     <tr>
                        <td colspan="2" bgcolor="#9E9E9E"></td>
                        <td style="text-align:center;"><b>'.$total_order_monthly.'</b></td>
                        <td style="text-align:center;"><b>RM&nbsp;'.$total_sale_monthly.'</b></td>
                     </tr>
	               </tbody>
	            </table>
         ';

         //display the table template with data
         echo $table;

      } else {

        	//return error - no record found
			echo'
				<div class="overlay overlay-edit">
					<div class="popup item2">
						<a class="close" href="index.php">&times;</a>
						<div class="content">
							<h2>Failed</h2>
							<p>No record found for those selected date.</p>
						</div>
					</div>
				</div>
			';
      }
   }

   //function generate report end

   //close connection
   $connection->close();
?>