<?php

   
   error_reporting(0);
ini_set('display_errors', 1);
   include __DIR__ . "/../include/header-functions.php";
   
$user_id="";
  if(!isset($_POST['user_id']) || empty($_POST['user_id']) ){echo "0";exit;}
		else {$user_id=$_POST['user_id'];
	
		$details=$shared->getTotalsDetailsByUID($user_id);
		echo '<table class="table table-striped text-left prod table-hover table-bordered table-condensed">
		     <tr>
		       <th>Date</th>
		       <th>Amount</th>
		     </tr>';
		foreach ($details as $prod) { 
		    echo "<tr onclick='getChecksProducts(".$prod['order_id'].")'>";
		     	echo '<td class="prod">';
		     	echo $prod['date'];
		     	echo '</td>';
		     	
		     	echo '<td class="prod">';
		     	echo $prod['TotalAmount'];
		     	echo '</td>';
		     	
		     echo "</tr>";
				}
         echo '</table>';
		
		
		}
		
		
		
	
?>

   
         




