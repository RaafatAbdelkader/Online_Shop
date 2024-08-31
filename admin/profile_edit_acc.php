<?php
    if(session_status() === PHP_SESSION_NONE){
        session_start();
        include_once ("../framework/functions.php");
        include_once ("../framework/config.php");
    }
    if(isset($_SESSION['admin_login'])){
        include_once("header.php");
        include_once("profile.php");
        if(isset($_POST['submit'])){
                    //action
        }else{
            ?>
                <div class="row">
                    <div class="col-2"></div>
                    <div class="col-6">
                        <div class="alert alert-primary text-center " role="alert">
                           Edit Account 
                        </div> 
                        <form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF'])?>">
                            <label for="username inline col-sm-1">Username</label>
                            <input type="text" class="form-control col-sm-3" name="username" id="username" value="<?php echo $_SESSION['admin_username']?>">
                            <label for="email">Email</label>
                            <input type="text"  name="email" class="form-control" id="email"  value="<?php echo $_SESSION['admin_email']?>">  
                            <button type="submit" class="btn btn-secondary col-sm-12 mt-3" name="submit">Update</button>
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
