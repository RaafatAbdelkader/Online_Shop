<?php
    if(session_status() === PHP_SESSION_NONE){
        session_start();
        include_once ("../framework/functions.php");
        include_once ("../framework/config.php");
    }
    if(isset($_SESSION['admin_login'])){
        include_once("header.php");
        include_once("admins.php");
        if(isset($_GET["admin_id"])){
            $admin_id=intval($_GET["admin_id"]);
            if($admin_id==0){
                alert("f","Fehler aufgetreten");
                redirect("admins_view.php");
            }elseif($admin_id==1){
                alert("f","Admin darf weder bearbeitet noch gelöscht werden");
                redirect("admins_view.php");
            }else{
                $con=db_connect();
                $q="select admin_username, admin_email from admins where admin_id='$admin_id'";
                $result=mysqli_query($con,$q);
                if(mysqli_num_rows($result)==1){
                    $q="delete from admins where admin_id='$admin_id'";
                    $result=mysqli_query($con,$q);
                    if($result){
                        alert("S","Admin wurde erfolgreich gelöscht");
                        redirect("admins_view.php");
                    }
                }else{
                    alert("F","Admin kann nicht gelöscht werden");
                    redirect("admins_view.php");
                }
                $con->close();
                
            }
        }else{
            alert("f","Fehler aufgetreten");
            redirect("admins_view.php");
        }
        include_once("footer.php");
    }else{
        include_once("login.php");
    }

?>