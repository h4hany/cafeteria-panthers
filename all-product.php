<?php require_once('database.php');?>
<?php //require_once('register-check.php');?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Products</title><link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="css/style.css">

    <script src="js/jquery-1.11.2.js"></script>

    <script src="js/bootstrap.js"></script>
    <link rel="stylesheet" href="font-awesome-4.5.0/css/font-awesome.css">


</head>
<body>
<div class="container">
    <?php require_once ('layout/header.php');?>
    <br><br><br><br><br><br>
    <h3 id="add"><a href="add-product.php">Add Product</a></h3>
    <div class="row">
        <div class="btn-group btn-group-justified">

            <div class="table-responsive">
                <table class='table table-hover table-striped table-bordered '>
                    <thead>
                    <tr>

                        <th> Product </th>
                        <th> Price </th>
                        <th> Image </th>
                        <th> Action </th>
                    </tr>
                    </thead>
                    <?php

                    error_reporting(E_ALL);
                    ini_set('display_errors', 1);


                    //$sql = "SELECT * FROM `user` WHERE user_id > 1 ";
                    $sql="select * from `product` where display='yes'";
                    $result = mysqli_query($connection, $sql);

                    //$row= mysqli_fetch_assoc($result);

                    while( $row = mysqli_fetch_array($result)) {
                        echo "<tr class='info'>";
                        echo "<td>" . $row['prod_name'] . "</td>";
                        echo "<td>" . $row['price'] . "</td>";
                        echo "<td><img src=" . $row['pic_link'] . " width='10%'></td>";
                        if($row['status']=="available") {
                            echo "<td><a class='btn btn-success' href='edit-product.php?ID=" . $row['prod_id'] . "'>edit</a>&nbsp; <a class='btn btn-danger' href='delete-product.php?ID=" . $row['prod_id'] . "'>delete</a><br><div  id='status" . $row['prod_id'] . "' class='text-success'><i class='fa fa-toggle-on fa-3x' onclick='changeProudctStatusAvail(".$row['prod_id'].")'></i></div></td>";
                        }else{
                            echo "<td><a class='btn btn-success' href='edit-product.php?ID=" . $row['prod_id'] . "'>edit</a>&nbsp; <a class='btn btn-danger' href='delete-product.php?ID=" . $row['prod_id'] . "'>delete</a><br><div  id='status" . $row['prod_id'] . "' class='text-danger'><i id='status' class='fa fa-toggle-off fa-3x' onclick='changeProudctStatusUnAvail(" . $row['prod_id'] . ")'></i></td>";
                        }
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
