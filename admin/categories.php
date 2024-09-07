
<?php 
    if(session_status() === PHP_SESSION_NONE){
        include_once ("../framework/functions.php");
        redirect("categories_viw.php",0);
    }

    if(isset($_SESSION['admin_login'])){
        ?>
                        <ul class="nav nav-pills nav-stacked  col-md-12">
                            <li class="btn col-md-12 mb-4">
                                <a href="categories_view.php" class='btn col-md-12 btn-<?PHP 
                                    if(stristr(getPageName(),"view")||stristr(getPageName(),"edit"))
                                        echo 'secondary';
                                    else
                                        echo 'primary';
                                    ?>'>Kategorien Übersicht
                                </a>
                            </li>
                            <li class="btn col-md-12 mb-4">
                                <a href="categories_add.php" class='btn col-md-12 btn-<?PHP 
                                    if(stristr(getPageName(),"categories_add"))
                                        echo 'secondary';
                                    else
                                        echo 'primary';
                                    ?>'>
                                    Kategorie Hinzufügen
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