<?php   
   error_reporting(0);
ini_set('display_errors', 1);
   include __DIR__ . "/../include/header-functions.php";
   
$order_id="";
  if(!isset($_POST['order_id']) || empty($_POST['order_id']) ){echo "0";exit;}
		else {$order_id=$_POST['order_id'];
		$details=$shared->getOrdersDetails($order_id);
		foreach ($details as $prod) { 
			echo '<div class="col-md-2 col-xs-6 prod"> ';
			echo '<span class="badge" >';
			echo $prod['product_price'] ;
			echo"L.E </span>";
			echo "<img src='uploads/";
			echo $prod['image'];
			echo "' />";
			echo "<h3>";
			echo $prod['product_name'];
			echo "</h3>";
			echo "<h3>";
			echo $prod['product_count'];
			echo "</h3>";
			echo '</div>';
		  
				}
         
		
		
		}
		
		
		
	
?>





