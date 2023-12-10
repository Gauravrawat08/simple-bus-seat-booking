<?php
include "db_connect.php";
error_reporting(0);

$id = $_GET["id"];
$query = "DELETE FROM `routes` WHERE `routes`.`id` = $id";

$result = mysqli_query($conn,$query);
if($result){

 echo  ' <script>confirm("Data Deleted successfully")</script>';
 header("location:pannel.php");
}
else{
    echo  ' <script>alert("Data Not Found")</script>';

}

 


 




?>