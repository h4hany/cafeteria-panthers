<?php 
   //error_reporting(E_ALL);
   //ini_set('display_errors', 1);
require_once __DIR__ . "/../include/header-functions.php";
  $data=array("order_id","status");
  $condtion="user_id='{$_SESSION['user_id']}'and (status='delivered' or status='done' )";
    $result=$GLOBALS['db']->select("orders",$data,$condtion);
    if($result){
      echo json_encode($result);
    }

?>

