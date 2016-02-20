<?php require_once('database.php');?>
<?php //require_once('register-check.php');?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>My Orders</title><link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="font-awesome-4.5.0/css/font-awesome.css">

    <script src="js/jquery-1.11.2.js"></script>

    <script src="js/bootstrap.js"></script>


</head>
<body>
<div class="container">
    <?php session_start();
    if($_SESSION['role'] == "user"){require_once ('layout/user-header.php');}
    else {require_once ('layout/header.php');}?>
    <br><br><br><br><br><br>
    <h3 id="add"><a href="add-product.php">Add Product</a></h3>
    <div class="row">
        <div class="btn-group btn-group-justified">

            <div class="table-responsive">
                <table class='table table-hover table-striped table-bordered '>
                    <thead>
                    <tr>

                        <th> Order Date </th>
                        <th> Status </th>
                        <th> Amount </th>
                        <th> Action </th>
                    </tr>
                    </thead>
                    <?php

                    error_reporting(E_ALL);
                    ini_set('display_errors', 1);

                    //$sql = "SELECT * FROM `user` WHERE user_id > 1 ";
                    $sql="SELECT `user.user_id` , `user.user_name` , SUM(orders_details.product_price  * orders_details.product_count) AS TotalAmount FROM `user`,`order`,`order_details` WHERE `order.user_id`=`user.user_id`
	                 and `order.status`='done'
	                 AND `order.order_id` = order_details.order_id And `order.user_id` = 2 HAVING SUM(order_details.price  * order_details.product_count) >0 order by `order.order_id` desc";
                    //$sql="select * from `order`  where  status='Processing' ";

                    $result = mysqli_query($connection, $sql);


                            while( $row = mysqli_fetch_array($result)) {


                                echo "<tr class='info'>";
                                // echo "<td>" . $row['date'] . "</td>";

                                echo '<td><button class="btn btn-default" data-toggle="collapse" data-target="#show-product">'.$row['date'].'</button>
                                      <div id="show-product" class="collapse">
                                      <p>'. $row['price'] .' EG<br><img src=" '. $row['pic_link'] .' " width="10%">
                                      <br>&nbsp;&nbsp;&nbsp;&nbsp;'.$row['quantity'].'
                                      '. $row['prod_name'] .'
                                      </p></div></td>';
                                echo "<td>" . $row['status'] . "</td>";
                                echo "<td>50 EG</td>";
                                echo "<td><a class='btn btn-danger' href='cancel-order.php?ID=" . $row['prod_id'] . "'>CANCEL</a></td>";
                                echo "</tr>";


                            }
                    ?>
                </table>
            </div>
        </div>

        <div class='col-lg-12 well'>
            <h1> Main Footer </h1>
        </div>
</body>
</html>
