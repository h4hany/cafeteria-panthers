<?php
/**
 * Created by PhpStorm.
 * User: hany
 * Date: 2/18/16
 * Time: 4:50 PM
 */
require_once('../database.php');
error_reporting(E_ALL);
ini_set('display_errors', 1);


$product_id=$_POST['product_id'];
$condition=$_POST['product_avail'];

if($condition=="product_unavail") {
    $query = "update `product` set status='available' where prod_id='$product_id'";
    $result = mysqli_query($connection, $query);
}elseif($condition=="product_avail"){
    $query = "update `product` set status='unavailable' where prod_id='$product_id'";
    $result = mysqli_query($connection, $query);
}
?>