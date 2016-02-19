<?php
/**
 * Created by PhpStorm.
 * User: hany
 * Date: 2/19/16
 * Time: 9:55 AM
 */
$sql="select prod_id from `product` status='unavailable'";
$result = mysqli_query($connection, $sql);

if($result){
    echo json_encode($result);
}