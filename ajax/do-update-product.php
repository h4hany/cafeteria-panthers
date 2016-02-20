<?php
/**
 * Created by PhpStorm.
 * User: hany
 * Date: 2/19/16
 * Time: 9:55 AM
 */
error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once ("../database.php");

$sql="select * from `product` status='unavailable'";
$result = mysqli_query($connection, $sql);

if($result){
    echo json_encode($result);
}