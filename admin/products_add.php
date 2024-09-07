<?php
    if(session_status() === PHP_SESSION_NONE){
        session_start();
        include_once ("../framework/functions.php");
        include_once ("../framework/config.php");
    }
    if(isset($_SESSION['admin_login'])){
        include_once("header.php");
        include_once("products.php");
        if(isset($_POST["submit"])){ 

            $new_product_name=validateValue($_POST['productname']);
            $new_product_desc=validateValue($_POST['product_desc']);
            $new_product_cat=intval(validateValue($_POST['category']));
            $new_product_price=intval(validateValue($_POST['price']));
            $new_photoname= time().validateValue($_FILES['image']['name']);
            $product_image_path = $_FILES['image']['tmp_name'];
            
            if ($new_product_name==NULL 
                || $new_product_desc==NULL 
                || $new_product_cat<1
                ||$new_product_price<1
                ||strlen($product_image_path<1)
            ){
                alert("f","Bitte alle Daten eingeben!");
                redirect("products_add.php");
            }else{
                $fileuploaded=move_uploaded_file($product_image_path,"../images/products/$new_photoname");
                if($fileuploaded){

                    $q="insert into products values( 
                         NULL,
                        '$new_product_name',
                        '$new_photoname',
                        '$new_product_desc' ,
                        '$new_product_price',
                        '$_SESSION[admin_id]',
                        '$new_product_cat')";  
                    $con=db_connect();
                    $result=mysqli_query($con,$q);
                    $con->close();
                    if($result){
                        alert("S","Daten wurden erfolgreich aktualisiert");
                        redirect("products_view.php");
                    }else{
                        alert("f","Produkt konnte wegen SQL-Fehler nicht gespeichert werden!");
                        redirect("products_add.php");
                    } 
                }else{
                    alert("f","Produkt konnte wegen Bild nicht gespeichert werden!");
                    redirect("products_add.php");
                }

        }

        }else{
            ?>
            <div class="row">
                <div class="col-2"></div>
                <div class="col-6">
                    <div class="alert alert-primary text-center " role="alert">
                        Produkt Hinzufügen
                    </div> 
                    <form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) ?>" enctype="multipart/form-data">
                        <label for="productname">Produktname</label>
                        <input type="text" class="form-control col-sm-3" name="productname" id="productname">
                        <label for="product_desc">Beschreibung</label>
                        <input type="text"  name="product_desc" class="form-control" id="product_desc">  
                        <label for="image">Neues Photo</label>
                        <input type="file"  name="image" class="form-control" id="image"  >  
                        
                        <label for="category">Kategorie auswählen</label>
                        <select name="category" id="category" class="form-control">
                            <?php 
                                $con=db_connect();
                                $cat_q="select * from categories";
                                $cat_result=mysqli_query($con,$cat_q);
                                $con->close();
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
              
        include_once("footer.php");
    
    }else{
        include_once("login.php");
    }

?>