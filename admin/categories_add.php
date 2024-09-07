<?php
    if(session_status() === PHP_SESSION_NONE){
        session_start();
        include_once ("../framework/functions.php");
        include_once ("../framework/config.php");
    }
    if(isset($_SESSION['admin_login'])){
        include_once("header.php");
        include_once("categories.php");

        if(isset($_POST["submit"])){ 
            $new_cat=validateValue($_POST['category']);
            if ( $new_cat==NULL) {
                alert("f","Bitte alle Daten eingeben!");
                redirect("categories_add.php");
            }else{
                $con=db_connect();
                $q="insert into categories values(NULL,'$new_cat','$_SESSION[admin_id]')";
                $result=mysqli_query($con,$q);
                $con->close();
                if($result){
                    alert("S","Daten wurden erfolgreich aktualisiert");
                    redirect("categories_view.php");
                }else{
                    alert("F","Änderungen können nicht gespeichert werden");
                    redirect("categories_add.php");
                }
            }

        }else{
            ?>
                <div class="row">
                    <div class="col-2"></div>
                    <div class="col-6">
                        <div class="alert alert-primary text-center " role="alert">
                            Kategorie bearbeiten
                        </div> 
                        <form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF'])?>">
                            <label for="productname">Nue Kategorie</label>
                            <input type="text" class="form-control col-sm-3" name="category" id="category">
                            <button type="submit" class="btn btn-secondary col-sm-12 mt-3 mb-5" name="submit">Aktualisieren</button>
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