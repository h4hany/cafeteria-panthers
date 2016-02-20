<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Welcome To Cafeteria</title>

    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="css/style.css">

    <script src="js/jquery-1.11.2.js"></script>
    <link rel="stylesheet" href="font-awesome-4.5.0/css/font-awesome.css">

    <script src="js/bootstrap.js"></script>


</head>
<?php
require_once ('database.php');

session_start();
$userID=$_GET['id'];

$sql = "SELECT * FROM `user` WHERE user_id= '$userID' ";
$result = mysqli_query($connection, $sql);

$row= mysqli_fetch_assoc($result);
if(isset($_SESSION['login_user'])){
?>
<body>
<br>

<div id="main" class="container">
    <!-- Nav Bar-->

    <?php
        if($_SESSION['role'] == "user"){require_once ('layout/user-header.php');}else {
        require_once ('layout/header.php');}

    ?>

    <!-- End NavBar-->
    <br><br><br><br><br><br>
    <div class="row">
        <div class="btn-group btn-group-justified">

            <div class="table-responsive">
                <table class='table table-hover table-striped table-bordered '>
                    <thead>
                    <tr>

                        <th> Order Date </th>
                        <th> Name </th>
                        <th> Room </th>
                        <th> Ext </th>
                        <th> Action </th>
                    </tr>
                    </thead>
                    <?php

                    error_reporting(E_ALL);
                    ini_set('display_errors', 1);


                    //$sql = "SELECT * FROM `user` WHERE user_id > 1 ";
                    $sql="select o.status,o.date,o.quantity,o.room_id,o.order_id,o.prod_id,u.user_name,u.room_ext,p.prod_id,p.pic_link,p.prod_name,p.price from `order` as o,`user` as u,`product` as p where o.prod_id=p.prod_id and o.user_id=u.user_id GROUP by o.order_id";
                    $result = mysqli_query($connection, $sql);

                    //$row= mysqli_fetch_assoc($result);
                    if($result)echo "true";else echo "false";
                    while( $row = mysqli_fetch_array($result)) {
                        echo "<tr class='info'>";
                        echo "<td>" . $row['date'] . "<div style='float:right'><button class=\"btn btn-default\" data-toggle=\"collapse\" data-target=\"#show-product\">+</button>
                        <div id=\"show-product\" class=\"collapse\"><p>". $row['price'] ." EG<br><img src=\" ". $row['pic_link'] ." \" width=\"10%\">
                         <br>".$row['quantity']." ". $row['prod_name'] ."</p></div></div></td>";
                        echo "<td>" . $row['user_name'] . "</td>";
                        echo "<td>" . $row['room_id'] . "</td>";
                        echo "<td>" . $row['room_ext'] . "</td>";
                        echo "<td><a>" . $row['status'] . "</a></td>";
                        echo "</tr>";


                    }

                    ?>
                </table>
            </div>
        </div>

        <div class='col-lg-12 well'>
            <h1> Main Footer </h1>
        </div>




    </div>

</body>
<?php }else{
    ?>
    <body>
    <div>
        you are not authorized 405 error
    </div>
    <a href="login.html">login</a>
    </body>
<?php }
?>
</html>