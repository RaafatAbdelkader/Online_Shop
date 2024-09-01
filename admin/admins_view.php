<?php
    if(session_status() === PHP_SESSION_NONE){
        session_start();
        include_once ("../framework/functions.php");
        include_once ("../framework/config.php");
    }
    if(isset($_SESSION['admin_login'])){
        include_once("header.php");
        include_once("admins.php");
        
        $con=db_connect();
        $q="select admin_id, admin_username,admin_email,admin_password from admins";
        $result=mysqli_query($con,$q);
        $con->close();
        if($result){
            if (mysqli_num_rows($result)>0) {
                ?>
                <table class="table text-center">
                    <thead >
                        <tr class="table-light">
                            <th scope="col">Benutzername</th>
                            <th scope="col">Passwort</th>
                            <th scope="col">Email</th>
                            <th scope="col">Bearbeiten</th>
                            <th scope="col">Löschen</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                           while($row=mysqli_fetch_array($result)){
                            ?>
                                <tr>
                                    <td><?php echo $row["admin_username"]?></td>
                                    <td>******</td>
                                    <td><?php echo $row["admin_email"]?></td>
                                       
                                        <?php 
                                            if ($_SESSION["admin_id"]==$row["admin_id"]&& $row["admin_id"]!=1) {
                                                
                                                ?>
                                                <td> 
                                                    <a  href="admins_edit.php?admin_id=<?php echo $row['admin_id']?>">
                                                        <span class="bi bi-pencil"></span>
                                                    </a>
                                                </td>
                                                <td>
                                                    <a  href="admins_delete.php?admin_id=<?php echo $row['admin_id']?>">
                                                        <span class="bi bi-trash text-danger"></span>
                                                    </a>
                                                </td>
                                
                                                <?php
                                            }elseif($_SESSION["admin_art"]=="super" && $row["admin_id"]!=1){
                                                ?>
                                                    <td>
                                                        <a href="admins_edit.php?admin_id=<?php echo $row['admin_id']?>">
                                                            <span class="bi bi-pencil"></span>
                                                        </a>
                                                    </td>

                                                    <td>
                                                        <a  href="admins_delete.php?admin_id=<?php echo $row['admin_id']?>">
                                                            <span class="bi bi-trash text-danger"></span>
                                                        </a>
                                                    </td>
                                
                                                <?php
                                            }else{

                                                ?>                                               
                                                    <td> 
                                                        <span style="cursor: not-allowed;" class="bi bi-pencil"></span>
                                                    </td>
                                                    <td> 
                                                        <span style="cursor: not-allowed;" class="bi bi-trash text-danger"></span>
                                                    </td>
                                                <?php
                                            }
                                            
                                        ?>
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