<?php

$SERVER = "localhost";
$username = "root";
$password = "";
$database = "internship";
$conn = mysqli_connect($SERVER , $username,$password,$database);
if(!$conn){
    mysqli_error($conn);
}
//echo "connect successfull";



?>