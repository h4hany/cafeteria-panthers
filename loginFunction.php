<?php
/**
 * Created by PhpStorm.
 * User: hany
 * Date: 2/8/16
 * Time: 9:20 PM
 */
require_once ('database.php');

error_reporting(E_ALL);
ini_set('display_errors', 1);



session_start();

//$error='';
if (isset($_POST['login_btn'])) {
    if (empty($_POST['login_name']) || empty($_POST['login_password'])) {
        $error = "Username or Password is empty";
    } else {

        $username = $_POST['login_name'];
        $password = $_POST['login_password'];

        $username = stripslashes($username);
        $password = md5(stripslashes($password));


        $sql = "SELECT * FROM `user` WHERE password='$password' AND user_name='$username'";

        $result = mysqli_query($connection, $sql);
        $row = mysqli_num_rows($result);
        $use= mysqli_fetch_assoc($result);
        $current_user_id=$use['user_id'];
        $role=$use['role'];
        // $row;
        if ($row == 1) {
            $_SESSION['login_user'] = $username;
            $_SESSION['login_user_id']=$current_user_id;
            $_SESSION['role'] = $role;
            //echo  $_SESSION['login_user'];
           // echo $_SESSION['login_user_id'];
          //  echo  $_SESSION['role'];

            if($_SESSION['role'] == "admin"){
                header("location: home.php?id=".$current_user_id);
            }
            elseif ($_SESSION['role'] =="user"){header("location: user-order.php");}

        } else {
            $error = "Username or Password is invalid";
        }

    }
}