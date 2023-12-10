<?php
 

function  exist_booking($conn, $customer_mail, $route_id)
{
    $sql = "SELECT * FROM `booking` WHERE customer_mail = '$customer_mail' AND route_id = '$route_id'";
    $result =  mysqli_query($conn, $sql);
    $num = mysqli_fetch_row($result);

    if ($num) {
        $row = mysqli_fetch_assoc($result);
        return $row["id"];
    }
    
    return false;
}





function get_from_table($conn, $tableName, $routeIDname, $routeidvalue, $toget)
{
    $sql = "SELECT * FROM `$tableName` WHERE `$routeIDname` = '$routeidvalue'";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
    if ($row) {
        return $row["$toget"];
     
    }
    return false;
}