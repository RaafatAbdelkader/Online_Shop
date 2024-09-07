<?php
    if(session_status() === PHP_SESSION_NONE){
        session_start();
        include_once ("../framework/functions.php");
        include_once ("../framework/config.php");
    }
    if(isset($_SESSION['admin_login'])){
        include_once("header.php");
        include_once("categories.php");
        if(isset($_GET["cat_id"])){
            $categories_id=intval(validateValue($_GET["cat_id"]));
            if($categories_id<1){
                alert("f","Fehler aufgetreten");
                redirect("categories_view.php");
            }else{
                $con=db_connect();
                $q="select * from categories where category_id='$categories_id'";
                $result=mysqli_query($con,$q);
                if(mysqli_num_rows($result)==1){
                    $pq="delete from products where fk_category_id='$categories_id'";
                    $pResult=mysqli_query($con,$pq);
                    if($pResult){
                        $cq="delete from categories where category_id='$categories_id'";
                        $cResult=mysqli_query($con,$cq);
                        if($cResult){
                            alert("S","Kategorie und die dazugehörigen Produkte wurden erfolgreich gelöscht");
                            redirect("categories_view.php");
                        }else{
                            alert("F","Kategorie konnte nicht gelöscht werden");
                            redirect("categories_view.php");
                        }
                        
                    }else{
                        alert("F","Die dazugehörigen Produkte konnten nicht gelöscht werden");
                        redirect("categories_view.php");
                    }
                }else{
                    alert("F","Kategorie kann nicht gelöscht werden");
                    redirect("categories_view.php");
                }
                $con->close();
                
            }
        }else{
            alert("f","Fehler aufgetreten");
            redirect("categories_view.php");
        }
        include_once("footer.php");
    }else{
        include_once("login.php");
    }

?>