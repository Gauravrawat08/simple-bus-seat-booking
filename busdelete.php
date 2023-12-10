<?php
include "db_connect.php";
error_reporting(0);

$id = $_GET["id"];
$delete_busno_query = "DELETE FROM buses WHERE `buses`.`id` = $id";
$deleteresult = mysqli_query($conn, $delete_busno_query);
if ($deleteresult) {
      
        echo  '<script>confirm("Bus Deleted successfully")</script>';
        header("location:bus.php");

} else {
    echo  ' <script>alert("Data Not delete")</script>';
}
 

 