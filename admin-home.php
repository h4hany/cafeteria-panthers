<?php include("include/header.php"); ?>
<div class="container page-header " style="min-height:400px;" >
  <h1 class="text-left">order </h1>
  <hr/>
  <?php if($_SESSION['usertype']=='admin'){ 
    $order=$shared->getCurrentOrders();
    ?>
        <table class="table table-striped text-left">
     <tr>
       <th>Order Date</th>
       <th>Name</th>
       <th>Room</th>
       <th>Ext</th>
       <th>Action</th>
     </tr>
  <?php
    foreach ($order as $data) {
    $order_details=$shared->getOrdersDetails($data['order_id']);

?>
     <!--<tr onclick="$('#tr_<?php echo $data['order_id']?>').slideToggle();" class='tr' id="par_<?php echo $data['order_id']?>">-->
    <tr class='tr' id="par_<?php echo $data['order_id']?>">
       <td><?php echo $data['date']?></td>
       <td><?php echo $data['name']?></td>
       <td><?php echo $data['room_number']?></td>
       <td><?php echo $data['ext']?></td>
       <td><a href="javascript:void(0)" onclick="changeStatus(<?php echo $data['order_id']?>)">Deliver</a></td>
     </tr>
     <tr id="tr_<?php echo $data['order_id']?>" data="<?php echo $data['order_id']?>">
       <td colspan="5">
         <?php
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

<?php    }
  ?>
     </table>
<script type="text/javascript">
 

$(function(){
 
   updatedata();
   removeCanceledorder();
   
});
 function updatedata(){
    var id= $('.table tr:nth-child(3)').attr('data');
    $.ajax({
           url:"ajax/do-get-new-home-admin.php",
           method:'get',
          data:{
            "id":id
           },
          success:function(response){
           if(response!=0){
            $(".table tr:nth-child(1)").after(response);
           } 
             updatedata();

          },
          complete:function(){
          }, cache: false,
          async:true
      });
  }
  function removeCanceledorder(){
          $.ajax({
           url:"ajax/do-remove-canceled-order.php",
           method:'get',
          data:{},
          success:function(response){
             for(var i=0;i<response.length;i++){
              console.log(response[i].order_id);
               $('#par_'+response[i].order_id).remove();
               $('#tr_'+response[i].order_id).remove();
             }
             removeCanceledorder();   
          },
          complete:function(){
          }, cache: false,
          async:true,
          dataType:'json'
      });
   }
  function changeStatus (id) {
             $.ajax({
                       url:"ajax/do-update-home-admin.php",
                       method:'get',
                        data:{
                            "id":id
                        },
                        success:function(response){
                          console.log(response);
                           if(response==1){
                             $("#tr_"+id).remove();
                             $("#par_"+id).remove();
                           }                           
                        },
                        complete:function(){
                        },
                        async:true
                      });
      }
</script>
   
  <p class="clearfix"></p>
 <?php }else{
  echo "you dont have permission to this page";
  } ?>
</div>
<?php include("include/footer.php"); ?>
