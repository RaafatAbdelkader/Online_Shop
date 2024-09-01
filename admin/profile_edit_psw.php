<?php
    if(session_status() === PHP_SESSION_NONE){
        session_start();
        include_once ("../framework/functions.php");
        include_once ("../framework/config.php");
    }
    if(isset($_SESSION['admin_login'])){
        include_once("header.php");
        include_once("profile.php");
        if (isset($_POST['submit'])) {
            $psw_n_1=validateValue($_POST['password_1']);
            $psw_n_2=validateValue($_POST['password_2']);
            if( $psw_n_1==NULL ||  $psw_n_2==NULL){
                alert("f","Bitte alle Daten eingeben");
                redirect(getPageName());
            }elseif($psw_n_1==$psw_n_2){
                $psw=enc_psw($psw_n_1);
                $con=db_connect();
                $q="update admins set admin_password='$psw' where admin_id='$_SESSION[admin_id]'";
                $result=mysqli_query($con,$q);
                $con->close();
                if($result){
                    alert("S","Ihr Passwort wurde erfolgreich aktualisiert");
                    redirect(getPageName());
                }else{
                    alert("f","SQL Fehler");
                    redirect(getPageName());
                }

            }else{
                alert("F","Ihre Eingaben stimmen nicht überein");
                    redirect(getPageName());
            }
        }else{
            ?>
            <div class="row">
                <div class="col-2"></div>
                <div class="col-6">
                    <div class="alert alert-primary text-center " role="alert">
                        Password Ändern
                    </div> 
                    <form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF'])?>">
                        <label for="password_1">Nues Passwort</label>
                        <input type="password" class="form-control col-sm-3" name="password_1" id="password_1">
                        <label for="password_2">Passwort bestätigen</label>
                        <input type="password"  name="password_2" class="form-control" id="password_2"> 
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
