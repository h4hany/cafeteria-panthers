<?php 
   
   error_reporting(0);
ini_set('display_errors', 1);
   include __DIR__ . "/../include/header-functions.php";
   
$password="";
$email="";
$cpassword="";  
$roomNo="";
$ext=""; 
$Filename="";
$nameimg="";
$name="";
$error='';
        
        if(!isset($_POST['name']) || empty($_POST['name'])){
            $error.="Please Enter your name <br/>";
        }else {$name=$_POST['name'];}

        if(!isset($_POST['email']) || empty($_POST['email'])){
          $error.="Please Enter your email <br/>";
        }else{
           $reg='/^[a-zA-Z_.0-9]+@[a-z0-9]+\.[a-z]{2,3}|\.[a-z]{2}$/i';  
           $v=preg_match($reg,trim($_POST['email']));
           if(!preg_match($reg,trim($_POST['email'])))
            {
              $error.="Please Enter valid email <br/>";
            }else{
              $res=$admin->checkEmail($_POST['email']);
               if($res>=1){
                $error.="This Email Exist <br/>";
               }
               else { $email=$_POST['email']; }
            }

        }
        if(!isset($_POST['password']) || empty($_POST['password'])){
          $error.="Please Enter your password <br/>";
        }else {$password=$_POST['password'];}
        if(!isset($_POST['cpassword']) || empty($_POST['cpassword'])){
          $error.="Please Enter your confirm password <br/>";
        }else {
        $cpassword=$_POST['cpassword']; 
        	if($password != $cpassword){$error.="Password not matched <br/>";}
        
        }
        if(!isset($_POST['roomNo']) || empty($_POST['roomNo'])){
          $error.="Please Enter your room no <br/>";
        }else {$roomNo=$_POST['roomNo'];}
        if(!isset($_POST['ext']) || empty($_POST['ext'])){
          $error.="Please Enter your ext <br/>";
        }else {$ext=$_POST['ext']; }
       $accepted_image_types = array("image/gif", "image/jpg", "image/jpeg", "image/pjpeg", "image/png", "image/x-png");
       if(is_uploaded_file($_FILES['imageuser']['tmp_name']) && is_array($_FILES)) {
       if(!empty($_FILES['imageuser']['tmp_name'])){
        if ($_FILES['imageuser']['error'] > 0)
        {
        switch ($_FILES['imageuser']['error'])
        {
        case 1: $error.= 'File exceeded upload_max_filesize';
        break;
        case 2: $error.= 'File exceeded max_file_size';
        break;
        case 3: $error.= 'File only partially uploaded';
        break;
        case 4: $error.= 'No file uploaded';
        break;
        case 6: $error.= 'Cannot upload file: No temp directory specified';
        break;
        case 7: $error.= 'Upload failed: Cannot write to disk';
        break;
        }
        echo $_FILES['imageuser']['type'];
        }elseif (!in_array($_FILES['imageuser']['type'], $accepted_image_types ))
        {
        $error.= 'Problem: file is not type';
        #exit;
        }
          }}else {$error.="Please Add Image...";}
          
        if(!empty($error)){
		echo '<div class="alert alert-danger"><strong>Error!</strong>';
		echo $error;
		echo '</div>';
        }else{

          if (is_uploaded_file($_FILES['imageuser']['tmp_name']))
          {
            $nameimg = time().$_FILES['imageuser']['name'];
            $Filename = __DIR__.'/../uploads/'.$nameimg;
            if (!move_uploaded_file($_FILES['imageuser']['tmp_name'], $Filename))
            {
            echo '<div class="alert alert-danger"><strong>Error!</strong>';
            echo 'Problem: Could not move file to destination directory';
            echo '</div>';
            exit;
            }
          }
          $password = md5($password);
          //adding user data
           $data =array("name"=>"{$name}","email"=>"{$email}","password"=>"{$password}","image"=>"{$nameimg}","room_no"=>"{$roomNo}","ext"=>"{$ext}","user_type"=>'user');
          
          $result=false;
         if(isset($_POST['user_id']) && !empty($_POST['user_id'])){$result=$admin->user_update($data,$_POST['user_id']); } 
         else{$result=$admin->insert_user($data);  } 
         
          if ($result != false) {   
           if(isset($_POST['user_id']) && !empty($_POST['user_id'])){ 
            echo '<div class="alert alert-success"><strong>Success!</strong> User Edited thanks</div>';}
            else { 
            echo '<div class="alert alert-success"><strong>Success!</strong> User added thanks</div>';}
         }else{
          echo '<div class="alert alert-danger"><strong>Error!</strong>';
		 echo"Can't add this user...";
		 echo '</div>';
          array_map('unlink', glob($Filename)); 
         }
   }































?>
