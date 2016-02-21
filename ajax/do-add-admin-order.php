<?php 
   //error_reporting(E_ALL);
   //ini_set('display_errors', 1);
require_once __DIR__ . "/../include/header-functions.php";
//$data = array();
# escape all submitted values
//var_dump($_POST['orders']);
$date=date('Y-m-d h:i:s');
$_POST['nodes']=strip_tags($_POST['nodes']);
$room_number=strip_tags($_POST['room_number']);
//echo $_POST['user_id'];

$data =array("user_id"=>"{$_POST['user_id']}","date"=>"{$date}","room_number"=>"{$room_number}","status"=>"processing","nodes"=>"{$_POST['nodes']}");
$result=$order->inserOrder($data);
//$result=$GLOBALS['db']->add('orders',$data);
$id=$result;
$_POST['orders']=json_decode($_POST['orders']);
foreach ($_POST['orders'] as $key=>$value ){  
  $new=array("user_id"=>"{$_POST['user_id']}","product_id"=>"{$value->id_prod}","order_id"=>"{$id}","product_count"=>"{$value->count}","product_price"=>"{$value->price}");
    $ret= $GLOBALS['db']->add('orders_details',$new);
}

if($ret){
	echo("your data send");
}

?>

