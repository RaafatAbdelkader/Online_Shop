<?php
    if(session_status() === PHP_SESSION_NONE){
        session_start();
        include_once ("../framework/functions.php");
        include_once ("../framework/config.php");
    }
    if(isset($_SESSION['admin_login'])){
        include_once("header.php");
        include_once("admins.php");
        if(isset($_POST["submit"])){       
            $new_username=validateValue($_POST['username']);
            $new_email=validateValue($_POST['email']);
            $new_psw_1=validateValue($_POST['password_1']);
            $new_psw_2=validateValue($_POST['password_2']);
            $role=validateValue($_POST['role']);

            
            if ($new_username==NULL||$new_email==NULL ||$new_psw_1==NULL ||$new_psw_2==NULL||$role==NULL) {
                alert("f","Bitte alle Daten eingeben!");
                redirect(getPageName());
            }elseif($new_psw_1!=$new_psw_2){
                alert("F","Passwörter stimmen nicht überein");
                redirect(getPageName());
            }else{
                $new_psw=enc_psw($new_psw_1);
                $con=db_connect();
                $q_username="select * from admins where admin_username='$new_username'";
                $q_email="select * from admins where admin_email='$new_email'";
                $u_result=mysqli_query($con,$q_username);
                $e_result=mysqli_query($con,$q_email);
                if($u_result && mysqli_num_rows($u_result)>0){
                    alert("F","Benutzername: $new_username ist bereits vorhanden");
                    redirect(getPageName());
                }elseif($e_result && mysqli_num_rows($e_result)>0){
                   alert("F","email: $new_email ist bereits vorhanden");
                    redirect(getPageName());
                }
                else{
                    $q="insert into admins values(NULL,'$new_email','$new_username','$new_psw','$role')";
                    $result=mysqli_query($con,$q);
                    if($result){
                        alert("S","Daten wurden erfolgreich gespeichert");
                        redirect("admins_view.php");
                    }else{
                        alert("F","SQL Fehler");
                       redirect(getPageName());
                    }
                }
                $con->close();
                
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
                            <input type="text" class="form-control col-sm-3" name="username" id="username">
                            <label for="Role">Rolle</label>
                            <select class="select form-control" id="Role" name="role">
                                <option type="password"  class="option" value="normal">Normal Admin</option>
                                <option type="password"  class="option" value="super">Super Admin</option>
                            </select>
                            <label for="email">Email</label>
                            <input type="text"  name="email" class="form-control" id="email">  
                            <label for="password_1">Passwort</label>
                            <input type="password"  name="password_1" class="form-control" id="password_1">
                            <label for="password_2">Passwort bestätigen</label>
                            <input type="password"  name="password_2" class="form-control" id="password_2">  
                            <button type="submit" class="btn btn-secondary col-sm-12 mt-3" name="submit">Speichern</button>
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