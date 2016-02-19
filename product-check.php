<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
require_once('database.php');
$error="";
$uploadOk=1;
$errorCheck=0;
$target_file="";
$product_name="";
$product_cat=0;
$price=0;
if (! isset($_POST['product-name']) || empty($_POST['product-name']) ) {$error .="No Product Name ";$errorCheck=1;}else {$product_name = $_POST['product-name'];}
if (! isset($_POST['product-cat']) || empty($_POST['product-cat']) ) {$error .="No Product Category ";$errorCheck=1;}else {$product_cat = $_POST['product-cat'];}
if (! isset($_POST['price']) || empty($_POST['price']) ) {$error .="No Product Price  ";$errorCheck=1;}else {$price = $_POST['price'];}

if ($errorCheck != 1) {

    $target_dir = "uploads/";
    $timestamp = time() * (24 * 60 * 60);
//$_FILES["image"]["name"]
    $target_file = $target_dir . $timestamp . "." . basename($_FILES["product-img"]["type"]);
    $uploadOk = 1;
    $imageFileType = pathinfo($target_file, PATHINFO_EXTENSION);
// Check if image file is a actual image or fake image
    if (isset($_POST["submit"])) {
        $check = getimagesize($_FILES["product-img"]["tmp_name"]);
        if ($check !== false) {
            echo "File is an image - " . $check["mime"] . ".";
            $uploadOk = 1;
        } else {
            $error .= "<br>File is not an image.";
            $uploadOk = 0;
        }
    }

// Check file size
    if ($_FILES["product-img"]["size"] > 500000) {
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
        if (move_uploaded_file($_FILES["product-img"]["tmp_name"], $target_file)) {
            //echo "The file ". basename( $_FILES["image"]["name"]). " has been uploaded.";
        } else {
            $error .= "<br>Sorry, there was an error uploading your file.";
        }
    }

    $query = "insert into `product` (prod_name,price,pic_link,cat_id,status,display) VALUES ('$product_name','$price','$target_file','$product_cat','available','yes')";
    $result = mysqli_query($connection, $query);
    if ($result) {
        echo "add";
    } else {
        echo "error";
    }
    header("Location: http://localhost/cafeteria/all-product.php");
}
else{header("Location: http://localhost/cafeteria/add-product.php?error=".$error);}

?>
