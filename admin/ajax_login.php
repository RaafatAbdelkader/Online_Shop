<?php
    if(session_status() === PHP_SESSION_NONE){
        session_start();
        include_once ("../framework/functions.php");
        include_once ("../framework/config.php");
    }

    $username=validateValue($_POST["username"]);
    $password=validateValue($_POST["password"]);
    $password=enc_psw($password);
    $con_link =db_connect();
    $sql="select * from admins where admin_username='$username' and admin_password='$password'";
    $result=mysqli_query($con_link,$sql);
    $con_link->close();
    if($result){
        if(mysqli_num_rows($result)>0){
            $row=mysqli_fetch_array($result);
            $_SESSION["admin_login"]="yes";
            $_SESSION["admin_id"]=$row["admin_id"];
            $_SESSION["admin_username"]=$row["admin_username"];
            $_SESSION["admin_email"]=$row["admin_email"];
            $_SESSION["admin_art"]=$row["admin_art"];
            echo("success");
        }else{
            echo("Bitte geben Sie richtige Daten ein!");
        }
    }else{
        echo("Bitte geben Sie richtige Daten ein!");
        
    }
    