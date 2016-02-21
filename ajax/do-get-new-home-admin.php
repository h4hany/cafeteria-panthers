<?php 
   //error_reporting(E_ALL);
   //ini_set('display_errors', 1);
require_once __DIR__ . "/../include/header-functions.php";
//$data = array();
# escape all submitted values
//var_dump($_POST['orders']);
$id=$_GET['id'];
$arr =[];
$tables="users,orders";
$condition="orders.user_id=users.user_id
	                 and orders.status='processing'
	                 and order_id > '{$id}' 
	                 order by orders.order_id desc";
      
//while (count($query)==0){
   $orders_data=$GLOBALS['db']->select($tables,$arr,$condition);
  // sleep(1000);
//}
   if(count($orders_data)==0){
   	echo "0";
   }else{
   	sleep(1);
foreach ($orders_data as $data_a) {
	/*$tables2="products,orders_details";
	$data2=[];
	 $condition2="orders_details.product_id=products.product_id
	                 and orders_details.order_id='{$data_a['order_id']}'
	                 order by orders_details.order_id desc";
	  $order_details=$GLOBALS['db']->select($tables2,$data2,$condition2);*/
    $order_details=$shared->getOrdersDetails($data_a['order_id']);


?>
  <tr class='tr' id="par_<?php echo $data_a['order_id']?>">
       <td><?php echo $data_a['date']?></td>
       <td><?php echo $data_a['name']?></td>
       <td><?php echo $data_a['room_number']?></td>
       <td><?php echo $data_a['ext']?></td>
       <td><a href="javascript:void(0)" onclick="changeStatus(<?php echo $data_a['order_id']?>)">Deliver</a></td>
     </tr>
     <tr id="tr_<?php echo $data_a['order_id']?>" data="<?php echo $data_a['order_id']?>">
       <td colspan="5">
         <?php
           //var_dump($order_details);
             $total=0;
            foreach ($order_details as $prod) { 
              $total +=$prod['product_price'] *$prod['product_count'] ;
              ?>
             <div class="col-md-2 col-xs-6 prod"> 
               <span class="badge" ><?php echo $prod['product_price'] ;?> L.E </span>
               <img src="uploads/<?php echo $prod['image'] ;?>" />
               <h3><?php echo $prod['product_name'] ;?></h3>
                <h3><?php echo $prod['product_count'] ;?></h3>
             </div>
    
           <?php }
           echo"<p class='clearfix'></p>";
           echo"<h3 class='blue pull-right'>total={$total} EGP</h3>";
         ?>
       </td>
     </tr>
<?php
  }

}?>

