<?php
require_once ('database.php');
$editId=$_GET['ID'];
$query="select u.user_name,u.email,u.password,um.room_id,r.room_ext from `user` as u ,`user_room` as um,`room` as r where u.user_id=um.user_id and um.room_id=r.room_id ";

//$query="select * from `user` where user_id='$editId'";
$result=mysqli_query($connection, $query);
//header("Location: http://localhost/cafeteria/all-users.php");

while($row = mysqli_fetch_array($result)){
?>
<!DOCTYPE HTML>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title></title>
    <link rel="stylesheet" href="css/bootstrap.css">
    <title></title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="font-awesome-4.5.0/css/font-awesome.css">

    <script src="js/jquery-1.11.2.js"></script>

    <script src="js/bootstrap.js"></script>


</head>
<body>
<div class='container text-center'>


    <?php require_once ('layout/header.php');?>
    <br><br><br>
    <div class='col-lg-12 text-left'>
        <h1>Add User</h1>
        <h5><?php
            if (isset($_GET['error'])) {
                echo '<h3 style="color:red">Error: </h3>';
                echo $_GET['error'];
                echo "<br><br>";
            }
            ?></h5>

        <form role="form" method="post" action="update-user.php?id=<?php echo $editId;?>" enctype="multipart/form-data">



            <div class="form-group row">
                <label class="col-lg-2" for="name"> Name:</label>
                <div class="col-lg-10">
                    <input type="text" class="form-control col-lg-9" id="name" name="name" value="<?php echo $row['user_name'];?>"></div>
            </div>

            <div class="form-group row">
                <label class="col-lg-2" for="email">Email:</label>
                <div class="col-lg-10">
                    <input type="text" class="form-control col-lg-9" id="email" name="email" value="<?php echo $row['email'];?>"></div>

            </div>



            <div class="form-group row">

                <label class="col-lg-2" for="password">Password:</label>
                <div class="col-lg-10">
                    <input type="password" class="form-control col-lg-9" id="password" name="password" value=""></div>
            </div>


            <div class="form-group row">

                <label class="col-lg-2" for="cpassword">Confirm Password:</label>
                <div class="col-lg-10">
                    <input type="password" class="form-control col-lg-9" id="cpassword" name="cpassword" value=""></div>
            </div>
            <div class="form-group row">
                <label class="col-lg-2" for="role"> Role:</label>
                <div class="col-lg-10">
                    <select class="form-control col-lg-9" name="role"><option value="user">User</option><option value="admin">Admin</option></select>
                </div>
            </div>

            <div class="form-group row">
                <label class="col-lg-2" for="room"> Room:</label>
                <div class="col-lg-10">
                    <input type="text" class="form-control col-lg-9" id="room" name="room" value="<?php echo $row['room_id'];?>"></div>
            </div>


            <div class="form-group row">
                <label class="col-lg-2" for="ext"> Ext:</label>
                <div class="col-lg-10">
                    <input type="text" class="form-control col-lg-9" id="ext" name="ext" value="<?php echo $row['room_ext'];?>"></div>
            </div>

            <div class="form-group row">
                <label class="col-lg-2" for="fileToUpload">Select image to upload:</label>
                <div class="col-lg-10">
                    <input type="file" name="fileToUpload" id="fileToUpload">
                </div>
            </div>


            <div class="form-group row text-center">
                <div class="col-lg-5">

                    <input type="submit" class="btn-lg btn-primary" name="fileToUploadSubmit" value="Submit"></div>

                <div class="col-lg-3">

                    <button type="reset" class="btn-lg btn-danger">Reset</button>
                </div>
            </div>
        </form>


    </div>

    <div class='col-lg-12 well'>
        <h1> Main Footer </h1>
    </div>

</div>

</body>

</html>
<?php }?>