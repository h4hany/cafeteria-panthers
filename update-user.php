<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
require_once ('database.php');
require_once ('DatabaseChecker.php');
$error="";
$uploadOk=1;
$errorCheck=0;
$target_file="";
$name="";
$email="";
$room=0;

$ext=0;
//$name = $_POST['name'];
//$room = $_POST['room'];
//$ext = $_POST['ext'];
//$email = $_POST['email'];
//$password=$_POST['password']
if (! isset($_POST['name']) || empty($_POST['name']) ) {$error .="No Name ";$errorCheck=1;}else {$name = $_POST['name'];}
if (! isset($_POST['room']) || empty($_POST['room']) ) {$error .="No room ";$errorCheck=1;}else {$room = $_POST['room'];}
if (! isset($_POST['ext']) || empty($_POST['ext']) ) {$error .="No ext  ";$errorCheck=1;}else {$ext = $_POST['ext'];}


if (! isset($_POST['email']) || empty($_POST['email']) ) {$error .="<br>No Email ";$errorCheck=1;}
else {$email = $_POST['email'];
    $v = "/^[a-zA-Z0-9_\-\.]+@[a-zA-Z0-9\-]+\.[a-zA-Z0-9\-\.]+$/";
    if (!preg_match($v, $email)){$error .="<br>Wrong Email ";$errorCheck=1;}}

if (! isset($_POST['password']) || empty($_POST['password']) ) {$error .="<br>No Password";$errorCheck=1;}else {$password = $_POST['password'];}

if (! isset($_POST['cpassword']) || empty($_POST['cpassword']) ) {$error .="<br>No Password";$errorCheck=1;}else {$cpassword = $_POST['cpassword'];}


if($password != $cpassword) {
    $error .="<br>Please Enter correct Captcha";
    $errorCheck=1;

}

if ($errorCheck != 1) {

    $target_dir = "uploads/";
    $timestamp = time() * (24 * 60 * 60);
//$_FILES["image"]["name"]
    $target_file = $target_dir . $timestamp . "." . basename($_FILES["fileToUpload"]["type"]);
    $uploadOk = 1;
    $imageFileType = pathinfo($target_file, PATHINFO_EXTENSION);
// Check if image file is a actual image or fake image
    if (isset($_POST["submit"])) {
        $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
        if ($check !== false) {
            echo "File is an image - " . $check["mime"] . ".";
            $uploadOk = 1;
        } else {
            $error .= "<br>File is not an image.";
            $uploadOk = 0;
        }
    }

// Check file size
    if ($_FILES["fileToUpload"]["size"] > 500000) {
        $error .= "<br>Sorry, your file is too large.";
        $uploadOk = 0;
    }
// Allow certain file formats

    if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
        && $imageFileType != "gif"
    ) {
        $error .= "<br>Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
        $uploadOk = 0;
    }
// Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {
        $error .= "<br>Sorry, your file was not uploaded.";
// if everything is ok, try to upload file
    } else {
        if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
            //echo "The file ". basename( $_FILES["image"]["name"]). " has been uploaded.";
        } else {
            $error .= "<br>Sorry, there was an error uploading your file.";
        }
    }


    $hashedPass = md5($password);
    $role=$_POST['role'];
    $updated_user_id=$_POST['id'];
    $bdCeck=new DatabaseChecker();
        $query = "UPDATE  `user` set user_name='$name',email='$email',password='$hashedPass',photo_link='$target_file',role='$role',room_id='$room',room_ext='$ext' where id='$updated_user_id'";
        $result = mysqli_query($connection, $query);
        if ($result) {

            echo "updated";


        } else {
            echo "error";
        }
        header("Location: http://localhost/cafeteria/all-users.php");

}else{header("Location: http://localhost/cafeteria/update-user.php?error=".$error);}


?>
