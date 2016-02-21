<?php
include __DIR__ . "/../include/header-functions.php";
$from =$_GET['from'];
$to=$_GET['to'];
$tables="orders";
$data=[];
$condition="orders.user_id = {$_SESSION['user_id']}
            and date > '{$from}' and date < '{$to}'
	        order by orders.order_id desc";
$order=$GLOBALS['db']->select($tables,$data,$condition);
////////////////////////////////////////////////////////
?>
    <table class="table table-striped text-left">
     <tr>
       <th>Order Date</th>
       <th>status</th>
       <th>Amount</th>
       <th>Action</th>
     </tr>
  <?php
    $all=0;
    foreach ($order as $data) {
    $order_details=$shared->getOrdersDetails($data['order_id']);
    $total=0;
    foreach ($order_details as $prod) { 
      $total +=$prod['product_price'] *$prod['product_count'] ;
    }
    $all+=$total;
?>
     <tr  id="par_<?php echo $data['order_id']?>" class='tr'>
       <td onclick="$('#tr_<?php echo $data['order_id']?>').slideToggle();"><?php echo $data['date']?></td>
       <td onclick="$('#tr_<?php echo $data['order_id']?>').slideToggle();"><?php 
              if($data['status']=='delivered'){
                echo "Out for delivery" ;
              }else{
                echo $data['status'];
              }
             ?>   
            </td>
       <td><?php echo $total .' EGP '; ?></td>
       <td onclick="$('#tr_<?php echo $data['order_id']?>').slideToggle();">
           <?php if($data['status']=="processing"){
              echo "<a href='javascript:void(0)' onclick='cancleOrder(".$data['order_id'].")' >Cancle</a>";
             }
            ?>
       </td>
     </tr>
     <tr style="display:none" id="tr_<?php echo $data['order_id']?>">
       <td colspan="5">
         <?php
            foreach ($order_details as $prod) { 
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

<?php    }
  ?>
     </table>
     <h3 class="blue pull-right"><?php echo $all.'  EGP' ?></h3>
  <p class="clearfix"></p>
