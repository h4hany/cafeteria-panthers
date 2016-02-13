<?php
require_once ('database.php');
$deletedId=$_GET['ID'];
$query="delete from `product` where prod_id='$deletedId'";
$result=mysqli_query($connection, $query);
header("Location: http://localhost/cafeteria/all-product.php");
?>