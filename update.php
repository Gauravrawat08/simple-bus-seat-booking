<?php
error_reporting(0);
session_start();
include 'db_connect.php';


if (strlen($_SESSION['Adminname']) == 0) {
  header("location:admin.php");
} else {
  $id = $_GET['id'];

  if (isset($_POST["edit"])) {
    $id = $_POST['id'];
    $busno  = $_POST["busno"];
    $fromcity = strtoupper($_POST["fromcity"]);
    $tocity = strtoupper($_POST["tocity"]);
    $depdate = $_POST["dep_date"];
    $deptime = $_POST["dep_time"];
    $arrdate = $_POST["arr_date"];
    $arrtime = $_POST["arr_time"];
    $cost = $_POST["cost"];

    //Update the bus route
    $updatequery =  "UPDATE `routes` SET 
    `fromcity` = '$fromcity',
    `tocity` = '$tocity',
    `bus_no` = '$busno',
    `route_dep_date` = '$depdate',
    `route_dep_time`= '$deptime',
    `route_arr_date` = '$arrdate',
    `route_arr_time` = '$arrdate',
    `cost` = '$cost',
    `route_created` = current_timestamp()	
     WHERE `routes`.`id` = $id";
     
     $updateresult = mysqli_query($conn, $updatequery);



    if ($updateresult) {
         // Redirect Admin Pannel Page
      echo '<script>alert("Update Data Successfully"); window.location.href="pannel.php";</script>';
    } else {
       //  show error
      echo '<script>alert("Data not update")</script>';
    }
  }









?>


  <!DOCTYPE html>
  <html lang="en">

  <head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <link rel="stylesheet" href="./css/style.css">



  </head>

  <body>
    <?php require  "partials/_navbaradmin.php"; ?>
    <section class="container">
      <div class="update-box">
        <?php
        $id = $_GET['id'];

        $query = "SELECT * FROM `routes` WHERE `id` = $id";
        $resultdata = mysqli_query($conn, $query);
        while ($row = mysqli_fetch_assoc($resultdata)) {

          $fromcity = $row["fromcity"];
          $tocity = $row["tocity"];
          $busno = $row["bus_no"];
          $route_dep_date = $row["route_dep_date"];
          $route_dep_time = $row['route_dep_time'];
          $route_arr_date = $row["route_arr_date"];
          $route_arr_time = $row['route_arr_time'];
          $cost = $row["cost"];
        }



        ?>

        <form action="update.php" method="post">




          <input type="text" id="id" name="id" value="<?php echo $id ?>" class="pop-intext" readonly hidden>

          <div>
            <label for="fromcity"> From City:</label>
            <input type="text" id="fromcity" name="fromcity" value="<?php echo $fromcity ?>" class="pop-intext">
          </div>

          <div>
            <label for="tocity"> To City:</label>
            <input type="text" id="tocity" name="tocity" value="<?php echo $tocity ?>" class="pop-intext">
          </div>

          <div>
            <label for="busno">Bus no:</label>

            <input type="text" name="busno" id="busno" value="<?php echo $busno ?>" readonly>





          </div>

          <div>
            <label for="dep_date"> DEPARTURE DATE</label>
            <input type="date" name="dep_date" id="dep_date" value="<?php echo $route_dep_date ?>" required>
          </div>

          <div>
            <label for="time">DEPARTURE TIME </label>
            <input type="time" id="time" name="dep_time" value="<?php echo $route_dep_time ?>" class="pop-intext">
          </div>

          <div>
            <label for="dur_time">ARRIVAL DATE </label>
            <input type="date" id="arr_date" name="arr_date" value="<?php echo $route_arr_date ?>" required>
          </div>

          <div>
            <label for="arr_time">ARRIVAL TIME :</label>
            <input type="time" id="time" name="arr_time" value="<?php echo $route_arr_time ?>" class="pop-intext">
          </div>

          <div>
            <label for="cost"> cost</label>
            <input type="number" id="cost" name="cost" value="<?php echo $cost ?>" class="pop-intext">
          </div>

          <div id="update-btn">

            <button type="submit" id="edit_btn" value="edit" name="edit">UPDATE</button>
          </div>
        </form>


      </div>







      </div>
      </div>





    </section>



  </body>


  </html>


<?php

};

?>