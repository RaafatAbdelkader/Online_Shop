<?php
    if(session_status() === PHP_SESSION_NONE){
        session_start();
        include_once ("../framework/functions.php");
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>onlineShop</title>
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/index.css">
</head>
<body >
    <?php  
            if(isset($_POST["submit"])){
                $username=validateValue($_POST["username"]);
                $password=validateValue($_POST["password"]);
                if($username==NULL || $password|| NULL){
                    $password=enc_psw($password);
                    $con_link =db_connect();
                    $sql="select * from admins where admin_username='$username' and admin_password='$password'";
                    $result=mysqli_query($con_link,$sql);
                    $con_link->close();
                    if($result){
                        if(mysqli_num_rows($result)>0){
                            $row=mysqli_fetch_array($result);
                            $_SESSION["admin_login"]="yes";
                            $_SESSION["admin_id"]=$row["admin_id"];
                            $_SESSION["admin_username"]=$row["admin_username"];
                            $_SESSION["admin_email"]=$row["admin_email"];
                            $_SESSION["admin_art"]=$row["admin_art"];
                            alert("S","welcome $username");
                            redirect("index.php",1);
                        }else{
                            alert("f","Falsche Daten, Bitte erneut versuchen!");
                            redirect("index.php");
                        }
                    }else{
                        alert("f","SQL Fehler");
                        redirect("index.php");
                    }
                }else{
                    alert("f","Bitte alle Daten eingeben");
                    redirect("index.php");
                }


            }else{
                ?>
                    <div class="row">
                        <div class="col-4 mx-auto mt-5">
                            <div class="alert alert-primary text-center" role="alert">
                                 Please sign in!
                            </div>
                            <form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF'])?>">
                                <label for="username inline col-md-1">Benutzername</label>
                                <input type="text" class="form-control col-md-3" name="username" id="username" placeholder="ex000">
                                <label for="psw">Password</label>
                                <input type="password"  name="password" class="form-control" id="psw">  
                                <button type="submit" class="btn btn-primary col-md-12 mt-3" name="submit">Login</button>
                            </form>
                        </div>
                    </div>
                   
                <?php
            }

        
    ?>
    <script src="../js/bootstrap.min.js"></script>
    <script src="../js/jquery.min.js"></script>
</body>
</html> 