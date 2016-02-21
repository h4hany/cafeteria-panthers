<?php
/**
 * Created by PhpStorm.
 * User: hany
 * Date: 2/19/16
 * Time: 3:36 PM
 */

error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once ("../database.php");
session_start();
$id=$_SESSION['login_user_id'];
$node=$_POST['nodes'];

$date=date('Y-m-d h:i:s');
$_POST['nodes']=strip_tags($_POST['nodes']);
$room_number=strip_tags($_POST['room_number']);

$sql="insert into `order`( `user_id`, `date`,`room_number`, `status`, `nodes`) VALUES
 ('$id','$date','$room_number','processing','$node')";
$result = mysqli_query($connection, $sql);


$lastID = mysqli_insert_id($connection);

$_POST['orders']=json_decode($_POST['orders']);
foreach ($_POST['orders'] as $key=>$value ){

    $sql2="INSERT INTO `order_details`(`user_id`, `product_id`, `order_id`, `product_count`, `product_price`) VALUES ('$id','$value->id_prod','$lastID','$value->count','$value->price')";
    $ret= mysqli_query($connection, $sql2);

}
if($ret){
    echo("your data send");
}
