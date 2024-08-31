<?php 
    if(session_status() === PHP_SESSION_NONE){
        session_start();
        include_once ("../framework/functions.php");
        include_once ("../framework/config.php");
    }
    if(isset($_SESSION["admin_login"])){
        ?>
            <!DOCTYPE html>
            <html lang="en">
            <head>
                <meta charset="UTF-8">
                <meta name="viewport" content="width=device-width, initial-scale=1.0">
                <title>onlineShop</title>
                <link rel="stylesheet" href="../css/bootstrap.min.css">
                <link rel="stylesheet" href="../css/index.css">
            </head>
            <body >
                <header class="bg-light" >
                        <ul class="nav nav-tabs text-center pt-2 ">
                            <li class="nav-item col bg-light ">
                                <a class="nav-link <?PHP if(stristr(getPageName(),"product")||getPageName()=="index.php")echo 'active'?>" href="index.php">Products</a>
                            </li>
                            <li class="nav-item col">
                                <a class="nav-link <?PHP if(stristr(getPageName(),"admin"))echo 'active'?>"href="admins.php">Admins</a>
                            </li>
                            <li class="nav-item col">
                                <a class="nav-link <?PHP if(stristr(getPageName(),"categor"))echo 'active'?>" href="categories.php">Categories</a>
                            </li>
                            <li class="nav-item col">
                                <a class="nav-link <?PHP if(stristr(getPageName(),"profile"))echo 'active'?>" href="profile_edit_acc.php">Profile</a>
                            </li>
                        </ul>
                    </header>
                    <div class="container-fluid mt-5">
                        <div class="row align-items-center">
                            <div class="col-md-3">
        <?php
    }else{
        include_once("login.php");
    }
?>