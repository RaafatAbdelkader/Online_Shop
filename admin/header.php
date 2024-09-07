<?php 
    if(session_status() === PHP_SESSION_NONE){
        include_once ("../framework/functions.php");
        redirect("index.php",0);
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
                <link rel="stylesheet" href="../css/bootstrap_icons.min.css">
                <style>
                    @import url("https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css"); */
                </style>
            </head>
            <body >
                <header class="bg-light" >
                        <ul class="nav nav-tabs text-center pt-2 ">
                            <li class="nav-item col bg-light ">
                                <a class="nav-link <?PHP if(stristr(getPageName(),"product")||getPageName()=="index.php")echo 'active'?>" href="index.php">Produkte</a>
                            </li>
                            <li class="nav-item col">
                                <a class="nav-link <?PHP if(stristr(getPageName(),"admin"))echo 'active'?>"href="admins_view.php">Admins</a>
                            </li>
                            <li class="nav-item col">
                                <a class="nav-link <?PHP if(stristr(getPageName(),"categor"))echo 'active'?>" href="categories_view.php">Kategorien</a>
                            </li>
                            <li class="nav-item col">
                                <a class="nav-link <?PHP if(stristr(getPageName(),"profile"))echo 'active'?>" href="profile_edit_acc.php">Profil</a>
                            </li>
                        </ul>
                    </header>
                    <div class="container-fluid mt-5">
                        <div class="row">
                          <div class="col-md-3">  
        <?php
    }else{
        include_once("login.php");
    }
?>