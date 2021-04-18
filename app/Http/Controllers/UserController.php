<?php 

session_start();

class UserController{

    public static function verifyLogin(){
        if($_SESSION['user']==null){
            header("location/:MI_engSoftware_fase4/resources/views/login.blade.php");
        }
    }
   
}