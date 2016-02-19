<?php session_start();?>
<script src="../cafeteria/js/myScript.js"></script>
<nav class="navbar-inverse navbar-fixed-top">
    <div class="container-fluid">
        <div class="navbar-header">
            <button class="navbar-toggle" data-toggle="collapse" data-target="#my-navbar">
                <span class="icon-bar"></span><span class="icon-bar"></span><span class="icon-bar"></span>
            </button>
            <div class="navbar-brand">
                <a href="">Cafeteria</a>
            </div>
        </div>
        <div class="collapse navbar-collapse" id="my-navbar">
            <ul class="nav navbar-nav">
                <li class="active"><a href="#">Home</a></li>
                <li><a href="../cafeteria/all-product.php">Products</a></li>
                <li><a href="../cafeteria/all-users.php">Users</a></li>
                <li><a href="#">Manual Orders</a></li>
                <li><a href="#">Checks</a></li>


            </ul>
            <ul class="nav navbar-nav navbar-right" style="color: white">
                <!-- <li><div><img id="greeting" src="<?php //echo $row['photo_link']; ?>" width="8%"></div></li>-->
                <li style="padding-right: 5px;padding-top: -6px"><h3><?php echo ucfirst($_SESSION['login_user']); ?>&nbsp;|&nbsp;<a href="../cafeteria/logout.php">LogOut</a></h3></li>

                <!--<li><h4><a href="logout.php">Logout</a></h4></li>-->
            </ul>
        </div>

    </div>
</nav>

<div style="padding-top: 39px;"><img id="greeting" src="<?php echo $row['photo_link']; ?>" width="3%"></div>
