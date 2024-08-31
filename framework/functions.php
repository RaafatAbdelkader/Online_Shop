<?php
function validateValue($value){
    $newValue=trim($value);
    $newValue=htmlspecialchars($newValue);
   return $newValue;
}

function alert($art="S",$msg){
    ?>
        <div class="alert text-center alert-<?php 
                                    if ($art=="S")
                                        echo"success";
                                    else
                                        echo "danger";
                                ?>"><?PHP
                                    echo $msg 
                                ?>
        </div>
    <?php
    
}
function redirect($url,$sec=1){
 header("refresh:$sec;url=$url");
}
function enc_psw($password){
    $psw= md5($password);
    $psw=substr($psw,0,5);
    $psw = sha1($psw);
    $psw=substr($psw,0,5);
    return $psw;
}
function getPageName(){
    $pageName=$_SERVER['PHP_SELF'];
    $index=strrpos($pageName,"/")+1;
    return substr($pageName,$index);
}

?>