<?php
$servername="localhost";
$dbusername = "root";
$password ="";
$dbname = "buspro";
$conn = mysqli_connect($servername,$dbusername,$password,$dbname);
if(!$conn){
    die("ERROR: could not connect." .mysqli_connect_error());
}
 
 ?>