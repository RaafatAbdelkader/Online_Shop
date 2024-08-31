<?php
    session_start();
    include_once ("../framework/functions.php");
    include_once ("../framework/config.php");
    if(isset($_SESSION["admin_login"])){
        include_once("header.php");
        ?>
            <div class="row align-items-center">
                    <div class="col-md-3">
                        <ul class="nav nav-pills nav-stacked  col-md-12">
                            <li class="btn col-md-12 mb-4"><a href="edit_account.php" class='btn btn-secondary col-md-12'>Edit Account</a></li>
                            <li class="btn col-md-12 mb-4"><a href="edit_password.php" class='btn btn-primary col-md-12'>Edit Password</a></li>
                            <li class="btn col-md-12 mb-4"><a href="logout.php" class='btn btn-primary col-md-12'>Log out</a></li>
                        </ul>
                    </div>
                    <div class="col-md-9">


                    </div>
            </div>
        <?php
        include_once("footer.php");
    }else{
        include_once("login.php");
    }

?>