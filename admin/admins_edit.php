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
                $oldResult=mysqli_query($con,$q);
                $con->close();
                if(mysqli_num_rows($oldResult)>0){
                    $oldRow=mysqli_fetch_array($oldResult);
                    if(isset($_POST["submit"])){       
                        $new_username=validateValue($_POST['username']);
                        $new_email=validateValue($_POST['email']);
                        if ($new_username==NULL||$new_email==NULL) {
                            alert("f","Bitte alle Daten eingeben!");
                            redirect("admins_edit.php?admin_id=".$admin_id);
                        }elseif($new_username==$oldRow["admin_username"]&& $new_email==$oldRow["admin_email"]){
                            alert("F","Keine neue Daten gefunden");
                            redirect("admins_edit.php?admin_id=".$admin_id);
                        }else{
                            $con=db_connect();
                            $q="update admins set admin_username='$new_username', admin_email='$new_email' where admin_id='$admin_id'";
                            $result=mysqli_query($con,$q);
                            $con->close();
                            if($result){
                                alert("S","Daten wurden erfolgreich aktualisiert");
                                redirect("admins_view.php");
                            }else{
                                alert("F","Änderungen können nicht gespeichert werden");
                                redirect("admins_view.php");
                            }
                        }
    
                    }else{
                        ?>
                            <div class="row">
                                <div class="col-2"></div>
                                <div class="col-6">
                                    <div class="alert alert-primary text-center " role="alert">
                                        Konto bearbeiten
                                    </div> 
                                    <form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']).'?admin_id='.$admin_id ?>">
                                        <label for="username">Benutzername</label>
                                        <input type="text" class="form-control col-sm-3" name="username" id="username" value="<?php echo $oldRow['admin_username']?>">
                                        <label for="email">Email</label>
                                        <input type="text"  name="email" class="form-control" id="email"  value="<?php echo $oldRow['admin_email']?>">  
                                        <button type="submit" class="btn btn-secondary col-sm-12 mt-3" name="submit">Aktualisieren</button>
                                    </form>
                                </div>
                            </div>  
                         <?php
                    }
                }else{
                    alert("F","Admin wurde nicht gefunden");
                }
            }
            
        }else{
            alert("f","Fehler aufgetreten");
            redirect(getPageName());
        }
        include_once("footer.php");
    
    }else{
        include_once("login.php");
    }

?>