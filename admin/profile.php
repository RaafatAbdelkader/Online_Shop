
<?php 
    if(session_status() === PHP_SESSION_NONE){
        session_start();
        include_once ("../framework/functions.php");
        include_once ("../framework/config.php");
    }

    if(isset($_SESSION['admin_login'])){
        ?>
                        <ul class="nav nav-pills nav-stacked  col-md-12">
                            <li class="btn col-md-12 mb-4">
                                <a href="profile_edit_acc.php" class='btn col-md-12 btn-<?PHP 
                                    if(stristr(getPageName(),"edit_acc"))
                                        echo 'secondary';
                                    else
                                        echo 'primary';
                                    ?>'>Edit Account
                                </a>
                            </li>
                            <li class="btn col-md-12 mb-4">
                                <a href="profile_edit_psw.php" class='btn col-md-12 btn-<?PHP 
                                    if(stristr(getPageName(),"edit_psw"))
                                        echo 'secondary';
                                    else
                                        echo 'primary';
                                    ?>'>Edit Password
                                </a>
                            </li>
                             <li class="btn col-md-12 mb-4">
                                <a href="logout.php" class='btn btn-primary col-md-12'>Log out</a>
                            </li>
                        </ul>
                    </div>
                    <div class="col-md-9">
         <?php
    }else{
        include_once("login.php");
    }

?>