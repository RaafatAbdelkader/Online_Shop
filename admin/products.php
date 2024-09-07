
<?php 
    if(session_status() === PHP_SESSION_NONE){
        include_once ("../framework/functions.php");
        redirect("products_viw.php",0);
    }

    if(isset($_SESSION['admin_login'])){
        ?>
                        <ul class="nav nav-pills nav-stacked  col-md-12">
                            <li class="btn col-md-12 mb-4">
                                <a href="index.php" class='btn col-md-12 btn-<?PHP 
                                    if(stristr(getPageName(),"index")||stristr(getPageName(),"product_edit"))
                                        echo 'secondary';
                                    else
                                        echo 'primary';
                                    ?>'>Produkte Übersicht
                                </a>
                            </li>
                            <li class="btn col-md-12 mb-4">
                                <a href="products_add.php" class='btn col-md-12 btn-<?PHP 
                                    if(stristr(getPageName(),"products_add"))
                                        echo 'secondary';
                                    else
                                        echo 'primary';
                                    ?>'>
                                    Produkt Hinzufügen
                                </a>
                            </li>
                        </ul>
                    </div>
                    <div class="col-md-9">
         <?php
    }else{
        include_once("login.php");
    }

?>