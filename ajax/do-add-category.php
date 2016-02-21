<?php 
   
   error_reporting(0);
ini_set('display_errors', 1);
   include __DIR__ . "/../include/header-functions.php";
   
	$category_name="";

        $error='empty';

	if(!isset($_POST['category_name']) || empty($_POST['category_name']) ){$error.="Please Enter Category Name";}
		else {$category_name=$_POST['category_name']; }
	


        if($error != "empty"){

        echo $error;
        }else{
        
           $data =array("category_name"=>"{$category_name}");
          $result=$admin->insert_category($data);  
          if ($result != false) {    
            echo "1";
         }else{
          echo"DB Error";
         }
   }


  



?>
