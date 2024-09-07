<?php
    if(session_status() === PHP_SESSION_NONE){
        session_start();
        include_once ("../framework/functions.php");
        include_once ("../framework/config.php");
    }
    if(isset($_SESSION['admin_login'])){
        include_once("header.php");
        include_once("products.php");
        
        if(isset($_GET["product_id"])){
            $product_id=intval(validateValue($_GET["product_id"]));
            if($product_id==0){
                alert("f","Fehler aufgetreten");
                redirect("products_view.php");
            }else{
                $con=db_connect();
                $q="select * from products where product_id='$product_id'";
                $cat_q="select * from categories";
                $oldResult=mysqli_query($con,$q);
                $cat_result=mysqli_query($con,$cat_q);
                $con->close();
                if(mysqli_num_rows($oldResult)>0){
                    $oldRow=mysqli_fetch_array($oldResult);
                    if(isset($_POST["submit"])){ 
                            
                        $new_product_name=validateValue($_POST['productname']);
                        $new_product_desc=validateValue($_POST['product_desc']);
                        $new_product_cat=validateValue($_POST['category']);
                        $new_product_price=validateValue($_POST['price']);
                        $new_photoname= time().validateValue($_FILES['image']['name']);
                        $product_image_path = $_FILES['image']['tmp_name'];

                        if ($new_product_name==NULL || $new_product_desc==NULL || $new_product_cat==NULL||$new_product_price==NULL) {
                            alert("f","Bitte alle Daten eingeben!");
                            redirect("product_edit.php?product_id=".$product_id);
                        }else{

                            $fileuploaded=move_uploaded_file($product_image_path,"../images/products/$new_photoname");
                            $con=db_connect();
                            if($fileuploaded){
                                $q="update products set product_name='$new_product_name',
                                 product_image='$new_photoname',
                                  product_desc='$new_product_desc' 
                                  , product_price='$new_product_price',
                                  fk_admin_id='$_SESSION[admin_id]',
                                  fk_category_id='$new_product_cat' where product_id='$product_id'";   
                            }else{
                                $q="update products set product_name='$new_product_name',
                                  product_desc='$new_product_desc', 
                                  product_price='$new_product_price',
                                  fk_admin_id='$_SESSION[admin_id]',
                                  fk_category_id='$new_product_cat' where product_id='$product_id'";   
                            }
                            $result=mysqli_query($con,$q);
                            $con->close();
                            if($result){
                                alert("S","Daten wurden erfolgreich aktualisiert");
                                redirect("products_view.php");
                            }else{
                                alert("F","Änderungen können nicht gespeichert werden");
                                redirect("product_edit.php?product_id=".$product_id);
                            }
                        }
    
                    }else{
                        ?>
                            <div class="row">
                                <div class="col-2"></div>
                                <div class="col-6">
                                    <div class="alert text-center " role="alert">
                                        <img src="../images/products/<?php echo $oldRow['product_image']?>" height='150 px' width='200 px'  alt="Kein Photo vorhanden">
                                    </div> 
                                    <div class="alert alert-primary text-center " role="alert">
                                        Produkt bearbeiten
                                    </div> 
                                    <form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']).'?product_id='.$product_id ?>" enctype="multipart/form-data">
                                        <label for="productname">Produktname</label>
                                        <input type="text" class="form-control col-sm-3" name="productname" id="productname" value="<?php echo $oldRow['product_name']?>">
                                        <label for="product_desc">Beschreibung</label>
                                        <input type="text"  name="product_desc" class="form-control" id="product_desc"  value="<?php echo $oldRow['product_desc']?>">  
                                        <label for="image">Product Image</label>
                                        <input type="file"  name="image" class="form-control" id="image"  >  
                                       
                                        <label for="category">Kategorie auswählen</label>
                                        <select name="category" id="category" class="form-control">
                                            <?php 
                                                while($r=mysqli_fetch_array($cat_result)){
                                                   $cat_name=$r['category_name'];
                                                   $cat_id=$r['category_id'];
                                                    ?>
                                                     <option value="<?php echo $cat_id?>"><?php echo $cat_name?></option>
                                                    <?php
                                                }
                                            ?>
                                           
                                        </select>
                                        <label for="price">Preis</label>
                                        <input type="number"  name="price" class="form-control" id="price"  value="<?php echo $oldRow['product_price']?>">  
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