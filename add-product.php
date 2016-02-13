<?php
require_once ('database.php');
$sql="select * from `category`";
$result = mysqli_query($connection, $sql);

//$row= mysqli_fetch_assoc($result);


//
?>
<!DOCTYPE HTML>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Add product</title>
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="css/style.css">

    <script src="js/jquery-1.11.2.js"></script>

    <script src="js/bootstrap.js"></script>


</head>
<body>
<div class='container text-center'>


    <?php require_once ('layout/header.php');?>
    <br><br><br>
    <div class='col-lg-12 text-left'>
        <h1>Add product</h1>
        <br><br><br>
        <h5><?php
            if (isset($_GET['error'])) {
                echo '<h3 style="color:red">Error: </h3>';
                echo $_GET['error'];
                echo "<br><br>";
            }
            ?></h5>

        <form role="form" method="post" action="product-check.php" enctype="multipart/form-data">



            <div class="form-group row">
                <label class="col-lg-2" for="product-name"> Product Name:</label>
                <div class="col-lg-10">

                    <input type="text" class="form-control col-lg-9" id="product-name" name="product-name"></div>
            </div>


            <div class="form-group row">
                <label class="col-lg-2" for="price"> Price:</label>
                <div class="col-lg-10">
                    <input min="0" step=".5" max="15" type="number" class="form-control col-lg-9" id="price" name="price">
                </div>

            </div>


            <div class="form-group row">
                <label class="col-lg-2" for="product-cat">Product Category:</label>
                <div class="col-lg-5">
                    <select class="form-control col-lg-4" id="product-cat" name="product-cat">
                        <?php while( $row = mysqli_fetch_array($result)) {?>
                         <option value="<?php echo $row['cat_id'];?>">
                             <?php echo $row['cat_name']; ?>
                         </option>

                       <?php }?>
                    </select>
                    <!--<input type="text" class="form-control col-lg-4" id="product-cat" name="product-cat">-->
                    </div>
                <div class="col-lg-4"><a  href="#">Add Category</a></div>

            </div>


            <div class="form-group row">
                <label class="col-lg-2" for="product-img">Product Image :</label>
                <div class="col-lg-10">
                    <input type="file" name="product-img" id="product-img">
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
