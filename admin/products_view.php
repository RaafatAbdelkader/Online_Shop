<?php
    if(session_status() === PHP_SESSION_NONE){
        include_once ("../framework/functions.php");
        redirect("index.php",0);
    }
    if(isset($_SESSION['admin_login'])){
        include_once("products.php");
        $con=db_connect();
        $q="select * from products";
        $result=mysqli_query($con,$q);
        $con->close();
        if($result){
            if (mysqli_num_rows($result)>0) {
                ?>
                    <table class="table text-center">
                        <thead >
                            <tr class="table-light">
                                <th scope="col">Produktname</th>
                                <th scope="col">Beschreibung</th>
                                <th scope="col">Preis</th>
                                <th scope="col">Category</th>
                                <th scope="col">Bearbeiten</th>
                                <th scope="col">Löschen</th>
                                <th scope="col">Image</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            while($row=mysqli_fetch_array($result)){
                                ?>
                                    <tr>
                                        <td class='pt-4'><?php echo $row["product_name"]?></td>
                                        <td class='pt-4'><?php echo $row["product_desc"]?></td>
                                        <td class='pt-4'><?php echo $row["product_price"]?></td>
                                        <?php
                                            $cat_id=$row["fk_category_id"];
                                            $con=db_connect();
                                            $q="select * from categories where category_id=$cat_id";
                                            $r=mysqli_query($con,$q);
                                            $con->close();
                                        ?>
                                        <td class='pt-4'><?php echo mysqli_fetch_array($r)["category_name"]?></td>
                                        <td class='pt-4'> 
                                            <a  href="product_edit.php?product_id=<?php echo $row['product_id']?>">
                                                <span class="bi bi-pencil"></span>
                                            </a>
                                        </td>
                                        <td class='pt-4'>
                                            <a  href="products_delete.php?product_id=<?php echo $row['product_id']?>">
                                                <span class="bi bi-trash text-danger"></span>
                                            </a>
                                        </td>
                                        <td>
                                            <img src="../images/products/<?php echo $row['product_image']?>" height='80 px' width='100 px'  alt="Kein Photo vorhanden">
                                        </td>

                                    </tr>
                
                            <?php
                            }
                            ?>
                        </tbody>
        
                    </table>
                <?php
                
            }else{
                alert("f","keine Daten vorhanden");
            }
        }else{
            alert("f","SQL Fehler");
        }
    }else{
        include_once("login.php");
    }

?>