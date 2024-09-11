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
                    <div class="row register">
                        <div class="col-4 mx-auto mt-5">
                            <div id="msg" class="alert alert-primary text-center animation2 shadow" role="alert">
                                 Please sign in!
                            </div>
                     
                            <div>    
                                <label for="username">Benutzername</label>
                                <input type="text" class="form-control col-md-3 f_input shadow" name="username" id="username" placeholder="ex000" >
                                <label for="psw">Password</label>
                                <input type="password"  name="password" class="form-control shadow f_input"  id="psw">  
                                <button id="submit" class="btn btn-primary col-md-12 mt-3 shadow submit" name="submit">Login</button>
                            </div>
                        </div>
                    </div>
    <script src="../js/bootstrap.min.js"></script>
    <script src="../js/jquery.min.js"></script>
    <script src="../js/js.js"></script>
</body>
</html> 