<?php 
   
   error_reporting(0);
ini_set('display_errors', 1);
   include __DIR__ . "/../include/header-functions.php";
   
$user_id="";
  if(!isset($_POST['user_id']) || empty($_POST['user_id']) ){echo "0";exit;}
		else {$user_id=$_POST['user_id'];}
	
//*********Delete*********//	
  if(isset($_POST['delete_p']) && !empty($_POST['delete_p']) ){$result=$admin->delete_user($user_id);
			if ($result != false) {    
			    echo "1";
			 }else{echo "0";}}

		


?>





