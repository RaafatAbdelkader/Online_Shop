<?php
    if(session_status() === PHP_SESSION_NONE){
        session_start();
        include_once ("../framework/functions.php");
        include_once ("../framework/config.php");
    }
    if(isset($_SESSION['admin_login'])){
        include_once("header.php");
        include_once("profile.php");
        if(isset($_POST['submit'])){
            $new_username=validateValue($_POST['username']);
            $new_email=validateValue($_POST['email']);
            if ($new_username==NULL||$new_email==NULL) {
               alert("f","Bitte alle Daten eingeben!");
            }else{
                if($new_username==$_SESSION["admin_username"] && $new_email==$_SESSION["admin_email"]){
                    alert("f","Keine neue Daten gefunden");
                    redirect(getPageName());
                }else{
                    $con=db_connect();
                    $q="update admins set admin_username='$new_username', admin_email='$new_email' where admin_id='$_SESSION[admin_id]'";
                    $result=mysqli_query($con,$q);
                    $con->close();
                    if($result){
                        $_SESSION['admin_username']=$new_username;
                        $_SESSION['admin_email']=$new_email;
                        alert("S","Daten wurden erfolgreich aktualisiert");
                        redirect(getPageName());
                    }else{
                        alert("F","Änderungen können nicht gespeichert werden");
                        redirect(getPageName());
                    }
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
                        <form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF'])?>">
                            <label for="username">Benutzername</label>
                            <input type="text" class="form-control col-sm-3" name="username" id="username" value="<?php echo $_SESSION['admin_username']?>">
                            <label for="email">Email</label>
                            <input type="text"  name="email" class="form-control" id="email"  value="<?php echo $_SESSION['admin_email']?>">  
                            <button type="submit" class="btn btn-secondary col-sm-12 mt-3" name="submit">Aktualisieren</button>
                        </form>
                    </div>
                </div>  
             <?php
        }
        include_once("footer.php");
    }else{
        include_once("login.php");
    }

?>
