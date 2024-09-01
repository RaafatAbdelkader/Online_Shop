
<?php 
    if(session_status() === PHP_SESSION_NONE){
        include_once ("../framework/functions.php");
        redirect("admins_view.php",0);
    }

    if(isset($_SESSION['admin_login'])){
        ?>
                        <ul class="nav nav-pills nav-stacked  col-md-12">
                            <li class="btn col-md-12 mb-4">
                                <a href="admins_view.php" class='btn col-md-12 btn-<?PHP 
                                    if(stristr(getPageName(),"admins_view"))
                                        echo 'secondary';
                                    else
                                        echo 'primary';
                                    ?>'>Admins Übersicht
                                </a>
                            </li>
                            <li class="btn col-md-12 mb-4">
                                <a href="admins_add.php" class='btn col-md-12 btn-<?PHP 
                                    if(stristr(getPageName(),"admins_add"))
                                        echo 'secondary';
                                    else
                                        echo 'primary';
                                    ?>'>Admin Hinzufügen
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