<?php

/**
 * Created by PhpStorm.
 * User: hany
 * Date: 2/15/16
 * Time: 5:36 PM
 */
class DatabaseChecker
{
        function checkName($name,$connection,$dbname){

            $query = "select * from '$dbname' where user_name='$name'";
            $result = mysqli_query($connection, $query);
            if($result){return true;}else{return false;}
         }
        function checkEmail($email,$connection,$dbname){

        $query = "select * from '$dbname' where email='$email'";
        $result = mysqli_query($connection, $query);
        if($result){return true;}else{return false;}
        }

}