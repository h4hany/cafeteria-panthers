<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title></title>

    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="css/style.css">

    <script src="js/jquery-1.11.2.js"></script>

    <script src="js/bootstrap.js"></script>
    <script src="js/code.js"></script>


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

<div id="main" class="container-fluid">
    <!-- Nav Bar-->
    <?php require_once ('layout/header.php');?>

    <!-- End NavBar-->


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