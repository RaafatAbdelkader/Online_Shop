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
            $category_id=intval(validateValue($_GET["cat_id"]));
            if($category_id<0){
                alert("f","Fehler aufgetreten");
                redirect("categories_view.php");
            }else{
                $con=db_connect();
                $q="select * from categories where category_id='$category_id'";
                $oldResult=mysqli_query($con,$q);
                $con->close();
                if(mysqli_num_rows($oldResult)>0){
                    $oldRow=mysqli_fetch_array($oldResult);
                    if(isset($_POST["submit"])){ 
                        $new_cat=validateValue($_POST['category']);
                        if ( $new_cat==NULL) {
                            alert("f","Bitte alle Daten eingeben!");
                            redirect("categories_edit.php?cat_id=".$category_id);
                        }elseif($new_cat==$oldRow['category_name']){
                            alert("f","Bitte eine neue Kategorie eingeben!");
                            redirect("categories_edit.php?cat_id=".$category_id);
                        }else{
                            $con=db_connect();
                            $q="update categories set category_name='$new_cat' 
                            where category_id='$category_id'";  
                            $result=mysqli_query($con,$q);
                            $con->close();
                            if($result){
                                alert("S","Daten wurden erfolgreich aktualisiert");
                                redirect("categories_view.php");
                            }else{
                                alert("F","Änderungen können nicht gespeichert werden");
                                redirect("categories_edit.php?cat_id=".$category_id);
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
                                    <form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']).'?cat_id='.$category_id ?>">
                                        <label for="productname">Nue Kategorie</label>
                                        <input type="text" class="form-control col-sm-3" name="category" id="category" value="<?php echo $oldRow['category_name']?>">
                                        <button type="submit" class="btn btn-secondary col-sm-12 mt-3 mb-5" name="submit">Aktualisieren</button>
                                    </form>
                                </div>
                            </div>  
                         <?php
                    }
                }else{
                    alert("F","Produkt wurde nicht gefunden");
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