<?php 
        $name=$_POST['name'];   
        $email=$_POST['email'];   
        $password=$_POST['password'];   
        $cpassword=$_POST['cpassword'];   
        $roomNo=$_POST['roomNo'];   
        $ext=$_POST['ext'];   
        $error='';
        if(empty($name)){
            $error.="Please Enter your Name <br/>";
        }
        if(empty($email)){
          $error.="Please Enter your email <br/>";
        }else{
           $reg='/^[a-zA-Z_.0-9]+@[a-z0-9]+\.[a-z]{2,3}|\.[a-z]{2}$/i';  
           $v=preg_match($reg,trim($email));
           if(!preg_match($reg,trim($email)))
            {
              $error.="Please Enter your not validate <br/>";
            }else{
              $res=$admin->checkEmail($email);
               if($res>=1){
                $error.="This Email Exist <br/>";
               }
            }

        }
        if(empty($password)){
          $error.="Please Enter your password <br/>";
        }
        if(empty($cpassword)){
          $error.="Please Enter your confirm password <br/>";
        }
        if(empty($roomNo)){
          $error.="Please Enter your room no <br/>";
        }if(empty($ext)){
          $error.="Please Enter your ext <br/>";
        }
       $accepted_image_types = array("image/gif", "image/jpg", "image/jpeg", "image/pjpeg", "image/png", "image/x-png");
       if(!empty($_FILES['imageuser']['tmp_name'])){
        if ($_FILES['imageuser']['error'] > 0)
        {
        switch ($_FILES['imageuser'][‘error’])
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
          }
        if(!empty($error)){
        echo "<p class='result'>".$error."<br/><a href='add-user.php'>Please try again</a></p>";
        }else{
          echo "<div class='result'> ";
          if (is_uploaded_file($_FILES['imageuser']['tmp_name']))
          {
            $nameimg = time().$_FILES['imageuser']['name'];
            $Filename = 'uploads/'.$nameimg;
            if (!move_uploaded_file($_FILES['imageuser']['tmp_name'], $Filename))
            {
            echo 'Problem: Could not move file to destination directory';
            exit;
            }
          }
          $password = md5($password);
           $data =array("name"=>"{$name}","email"=>"{$email}","password"=>"{$password}","image"=>"{$nameimg}","room_no"=>"{$roomNo}","ext"=>"{$ext}","user_type"=>'user');
          $res=$admin->insert_user($data);  
         if($res){
          echo "user added";
         }else{
          echo"<p class='result'> cant add this user</p>";
         }
   }
   echo"<p class='clearfix'></p>"



?>
