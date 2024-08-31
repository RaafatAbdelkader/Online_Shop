<?php
function db_connect(){
    $hostname="localhost";
    $db_username="root";
    $db_password=NULL;
    $db_name="online_shop";
    $con_link=@mysqli_connect($hostname,$db_username,$db_password,$db_name) OR die("Can not connect to database");
    return $con_link;
}

?>