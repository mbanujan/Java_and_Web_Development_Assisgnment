<?php
$servername="localhost";
$username="root";
$password="";
$dbname="bike rental";

$conn=mysqli_connect($servername,$username,$password,$dbname);
if(!$conn){ 
    echo "hello";
    //die("Connection Failed".mysqli_connect_error());
}


