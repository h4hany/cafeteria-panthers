<?php
include("database.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Welcome To Cafeteria</title><link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="font-awesome-4.5.0/css/font-awesome.css">

    <script src="js/jquery-1.11.2.js"></script>

    <script src="js/bootstrap.js"></script>


</head>
<body>
<div class="container page-header " style="min-height:400px;" >

    <h1 class="text-left">orders</h1>

    <?php
        session_start();
        if($_SESSION['role'] == "user"){require_once ('layout/user-header.php');}
            else {require_once ('layout/header.php');}
        if($_SESSION['role']=='user'){

        error_reporting(E_ALL);
        ini_set('display_errors', 1);


        //$sql = "SELECT * FROM `user` WHERE user_id > 1 ";
        $sql="select DISTINCT  room_id from `user`";
        $result = mysqli_query($connection, $sql);

        //$row= mysqli_fetch_assoc($result);


        ?>

        <div class="result error"></div>

  <div class="col-md-3 col-sm-6 col-xs-12  pull-left left_order text-center">
     <h3>orders</h3>
     <hr/>

     <form id="send_user_order" method="post">
       <ul id="orders" class="col-md-12 col-sm-12 col-xs-12"></ul>
       <div class="row">
         <textarea class="nodes form-control" name="nodes"></textarea><br/>
       </div>
       <div class="row">
       <select class="form-control" name="room_number" id="room_number">
         <option value="">room number</option>
         <?php  while( $row = mysqli_fetch_array($result)) { ?>
    <option value="<?php echo $row['room_id'] ?>"><?php echo $row['room_id'] ?></option>
<?php  } ?>
    </select>
    </div>
    <hr/>
    <div id="total"></div>
    <input type="button" class="btn btn-primary" name="confirm" value="Confirm" onclick="sendOrder()" id="button"/>
    </form>
    </div>
    <div class="col-md-9 col-xs-12 pull-right right_order">
        <h3 class="text-left">Last order</h3>
        <hr>
        <?php
        $sql1="select * from `product`";
        $result1 = mysqli_query($connection, $sql1);

        /*while( $prod = mysqli_fetch_array($result1)) {            ?>
            <div class="col-md-3 col-xs-6 prod" data="<?php echo $prod['prod_name'] ;?>" id="prod_last_<?php echo $prod['prod_id'] ;?>" onclick="addproduct(<?php echo $prod['prod_id'] ;?>)">
                <span class="badge" id="price_<?php echo $prod['prod_id'] ;?>" data="<?php echo $prod['price'] ;?>"><?php echo $prod['price'] ;?> L.E </span>
                <img src="<?php echo $prod['pic_link'] ;?>" width="40%"/>
                <h3><?php echo $prod['prod_name'] ;?></h3>
            </div>
        <?php } */?>
        <p class="clearfix"></p>
        <hr/>
        <?php
        while( $prod = mysqli_fetch_array($result1)) {            ?>
            <div class="col-md-3 col-xs-6 prod" data="<?php echo $prod['prod_name'] ;?>" id="prod_last_<?php echo $prod['prod_id'] ;?>" onclick="addproduct(<?php echo $prod['prod_id'] ;?>)">
                <span class="badge" id="price_<?php echo $prod['prod_id'] ;?>" data="<?php echo $prod['price'] ;?>"><?php echo $prod['price'] ;?> L.E </span>
                <img src="<?php echo $prod['pic_link'] ;?>" width="40%"/>
                <h3><?php echo $prod['prod_name'] ;?></h3>
            </div>
        <?php } ?>
    </div>
    <p class="clearfix"></p>
<?php }else{echo "you dont have permission to this page";} ?>
    </div>

<div class='col-lg-12 well'>
    <h1> Main Footer </h1>
</div>
</body>
</html>



