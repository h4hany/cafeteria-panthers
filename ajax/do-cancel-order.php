<?php

 include __DIR__ . "/../include/header-functions.php";
 $id=intval($_GET['id']);
  if(!empty($id)){
    $data=[];
    $condition="order_id='{$id}'";
    $result=$GLOBALS['db']->select("orders",$data,$condition);
    if(count($result)==1&&$result[0]['status']=='processing'){
      $data2=array("status"=>"cancled");
      $condition2="order_id='{$id}'";
      $GLOBALS['db']->edit('orders',$data2,$condition2);   
      echo "1";     	
    }else{
    	echo "0";
    }

  }




?>