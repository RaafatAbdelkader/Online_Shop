<?php
    if(session_status() === PHP_SESSION_NONE){
        session_start();
        include_once ("../framework/functions.php");
        include_once ("../framework/config.php");
    }
    if(isset($_SESSION['admin_login'])){
        include_once("header.php");
        include_once("categories.php");
        $con=db_connect();
        $q="select * from categories";
        $result=mysqli_query($con,$q);
        $con->close();
        if($result){
            if (mysqli_num_rows($result)>0) {
                ?>
                <table class="table text-center">
                    <thead >
                        <tr class="table-light">
                            <th scope="col">Kategoriename</th>
                            <th scope="col">Produktenanzahl</th>
                            <th scope="col">Bearbeiten</th>
                            <th scope="col">Löschen</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                           while($row=mysqli_fetch_array($result)){
                            ?>
                                <tr>
                                    <td><?php echo $row["category_name"]?></td>
                                    <td>
                                        <?php
                                         $con=db_connect();
                                         $p_q="select * from products where fk_category_id='$row[category_id]'";
                                         $r=mysqli_query($con,$p_q);
                                         $con->close(); 
                                            echo mysqli_num_rows($r);
                                        ?>
                                    </td>
                                    <td> 
                                            <a  href="categories_edit.php?cat_id=<?php echo $row['category_id']?>">
                                                <span class="bi bi-pencil"></span>
                                            </a>
                                    </td>
                                    <td>
                                        <a  href="categories_delete.php?cat_id=<?php echo $row['category_id']?>">
                                            <span class="bi bi-trash text-danger"></span>
                                        </a>
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

        include_once("footer.php");
    }else{
        include_once("login.php");
    }

?>