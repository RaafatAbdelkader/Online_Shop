<?php 
    if(session_status() === PHP_SESSION_NONE){
        session_start();
        include_once ("../framework/functions.php");
        include_once ("../framework/config.php");
    }

    if(isset($_SESSION['admin_login'])){
        include_once("header.php");
        session_destroy();
        alert("S","Logged out successfully");
        include_once("footer.php");
        redirect("index.php");
    }else{
        include_once("login.php");
    }

?>