<?php
require_once ('database.php');
$deletedId=$_GET['ID'];
$query="delete from `user` where user_id='$deletedId'";
$result=mysqli_query($connection, $query);
header("Location: http://localhost/cafeteria/all-users.php");
?>