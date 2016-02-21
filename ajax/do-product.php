<?php 
   
   error_reporting(0);
ini_set('display_errors', 1);
   include __DIR__ . "/../include/header-functions.php";
   
$product_id="";
  if(!isset($_POST['product_id']) || empty($_POST['product_id']) ){echo "0";exit;}
		else {$product_id=$_POST['product_id'];}
	
//*********Delete*********//	
  if(isset($_POST['delete_p']) && !empty($_POST['delete_p']) ){$result=$admin->delete_product($product_id);
			if ($result != false) {    
			    echo "1";
			 }else{echo "0";}}

		
//*********EditAvail*********//		
   if(isset($_POST['product_unavail']) && !empty($_POST['product_unavail']) ){$result=$admin->change_product_status_unavail($product_id);
			if ($result != false) {    
			    echo "1";
			 }else{echo "0";}}
	
		
//*********EditUnAvial*********//		
  if(isset($_POST['product_avail']) && !empty($_POST['product_avail']) ){$result=$admin->change_product_status_avail($product_id);
			if ($result != false) {    
			    echo "1";
			 }else{echo "0";}}


?>





