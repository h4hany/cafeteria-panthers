<?php
require_once ('database.php');
$deletedId=$_GET['ID'];
$query="update `order` set status='Cancel' where order_id='$deletedId'";
$result=mysqli_query($connection, $query);
header("Location: http://localhost/cafeteria/my-orders.php");
?>