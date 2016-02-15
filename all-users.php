<?php require_once('database.php');?>
<?php //require_once('register-check.php');?>
<!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Admin</title><link rel="stylesheet" href="css/bootstrap.css">
        <link rel="stylesheet" href="css/style.css">

        <script src="js/jquery-1.11.2.js"></script>

        <script src="js/bootstrap.js"></script>


    </head>
    <body>
    <div class="container">
        <?php require_once ('layout/header.php');?>
        <br><br><br><br><br><br>
        <h3 id="add"><a href="register.php">Add User</a></h3>
        <div class="row">
            <div class="btn-group btn-group-justified">

                <div class="table-responsive">
                    <table class='table table-hover table-striped table-bordered '>
                        <thead>
                        <tr>

                            <th> Full Name </th>
                            <th> Room </th>
                            <th> Profile Image </th>
                            <th> Ext </th>
                            <th> Action </th>
                        </tr>
                        </thead>
                        <?php

                        error_reporting(E_ALL);
                        ini_set('display_errors', 1);


                        //$sql = "SELECT * FROM `user` WHERE user_id > 1 ";
                        $sql="select u.user_id,u.user_name,u.photo_link,um.room_id,r.room_ext from `user` as u ,`user_room` as um,`room` as r where u.user_id=um.user_id and um.room_id=r.room_id ";
                        $result = mysqli_query($connection, $sql);

                        //$row= mysqli_fetch_assoc($result);

                            while( $row = mysqli_fetch_array($result)) {
                                echo "<tr class='info'>";
                                echo "<td>" . $row['user_name'] . "</td>";
                                echo "<td>" . $row['room_id'] . "</td>";
                                echo "<td><img src=" . $row['photo_link'] . " width='10%'></td>";
                                echo "<td>" . $row['room_ext'] . "</td>";
                                echo "<td><a class='btn btn-success' href='edit-user.php?ID=" . $row['user_id'] . "'>edit</a>&nbsp; <a class='btn btn-danger' href='delete.php?ID=" . $row['user_id'] . "'>delete</a></td>";
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
