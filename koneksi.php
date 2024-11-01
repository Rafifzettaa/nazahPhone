<?php

$server   = 'localhost';
$username = 'root';
$password = 'root';
$database = 'nazah';

$db=mysqli_connect($server,$username,$password,$database);

if(!$db){
    mysqli_connect_errno();
}

?>