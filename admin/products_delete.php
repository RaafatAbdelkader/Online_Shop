<?php
    if(session_status() === PHP_SESSION_NONE){
        session_start();
        include_once ("../framework/functions.php");
        include_once ("../framework/config.php");
    }
    if(isset($_SESSION['admin_login'])){
        include_once("header.php");
        include_once("admins.php");
        if(isset($_GET["product_id"])){
            $product_id=intval(validateValue($_GET["product_id"]));
            if($product_id<1){
                alert("f","Fehler aufgetreten");
                redirect("index.php");
            }else{
                $con=db_connect();
                $q="select * from products where product_id='$product_id'";
                $result=mysqli_query($con,$q);
                if(mysqli_num_rows($result)==1){
                    $q="delete from products where product_id='$product_id'";
                    $result=mysqli_query($con,$q);
                    if($result){
                        alert("S","Produkt wurde erfolgreich gelöscht");
                        redirect("index.php");
                    }
                }else{
                    alert("F","Product kann nicht gelöscht werden");
                    redirect("index.php");
                }
                $con->close();
                
            }
        }else{
            alert("f","Fehler aufgetreten");
            redirect("index.php");
        }
        include_once("footer.php");
    }else{
        include_once("login.php");
    }

?>
