<?php 
   error_reporting(E_ALL);
   ini_set('display_errors', 1);
 require_once __DIR__ . "/../include/header-functions.php";

          $result=$admin->select_categories();
          
          echo '<option value="SelectPlease">Select Category</option>';
          if($result){
		foreach($result as $row) {

				$category_id=$row['category_id'];
				$category_name=$row['category_name'];	
				echo '<option value="'.$category_id.'">'.$category_name.'</option>';
			}

			}



?>

