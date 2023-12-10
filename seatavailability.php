<?php
include 'db_connect.php';
error_reporting(0);
session_start();

if (strlen($_SESSION["Adminname"]) == 0) {
  $adminlog = false;
} else {
  $adminlog = true;
}






?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Search Your Buses</title>
  <link rel="stylesheet" href="./css/style.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>

</head>

<body>
  <?php if ($adminlog) {
    require  "partials/_navbaradmin.php";
  } else {
    require  "partials/_navbar.php";
  }
  ?>
  <section class="seat-container">

    <div class="left-side-container">

      <div class="second_search_box">

        <!-- bus Search Modal -->
        <form action="seatavailability.php" method="post">
          <select name="fromcity" class="searchInput2" id="">
            <option value="">FROM</option>
            <option value="rishikesh">RISHIKESH</option>
            <option value="haridwar">HARIDWAR</option>
            <option value="dehradun">DEHRADUN</option>
            <option value="delhi">DELHI</option>
          </select>
          <select name="tocity" class="searchInput2" id="">
            <option value="">TO</option>
            <option value="rishikesh">RISHIKESH</option>
            <option value="haridwar">HARIDWAR</option>
            <option value="dehradun">DEHRADUN</option>
            <option value="delhi">DELHI</option>

          </select>


          <input type="date" id="inputdate" name="dep_date" min="<?php date_default_timezone_set("Aisa/Kolkata");
                                                                  echo date("Y-m-d"); ?>" value="<?php echo ("yy-mm-dd"); ?>" class="searchInput2" required>
          <input type="submit" value="Search Buses" id="btn-smt">
        </form>
      </div>
    </div>
    <div class="right-side-container">



      <div class="pannel-result">

        <table class="route-list">
          <thead class="pannel-title-bar">

            <th class="pannel-span-box">From</th>
            <th class="pannel-span-box">To</th>
            <th class="pannel-span-box">Bus NO</th>

            <th class="pannel-span-box">Departure Date</th>
            <th class="pannel-span-box">Departure Time</th>
            <th class="pannel-span-box">DURATION Time</th>
            <th class="pannel-span-box">ARRIVAL Date Time</th>
            <th class="pannel-span-box">Cost</th>
            <th class="pannel-span-box">Action</th>

          </thead>
          <?php










if (isset($_POST['fromcity']) && isset($_POST["tocity"]) && isset($_POST["dep_date"])) {
  
  $fromcity = $_POST["fromcity"];
  $tocity  = $_POST["tocity"];
  $dep_date = $_POST["dep_date"];
  
  //Search the bus
            $sql = "SELECT * FROM `routes` WHERE `fromcity` = '$fromcity' AND `tocity` = '$tocity' AND `route_dep_date` = '$dep_date'";
            $result = mysqli_query($conn, $sql);
            while ($row = mysqli_fetch_assoc($result)) {


              $bus_no =  $row["bus_no"];
              $routeID = $row["route_id"];
              $fromcity =  $row["fromcity"];
              $tocity = $row["tocity"];
              $dep_date = $row["route_dep_date"];
              $dep_time = $row["route_dep_time"];
              $arr_date = $row["route_arr_date"];
              $arr_time = $row["route_arr_time"];
              $cost = $row["cost"];





              // Select the bus route  
              if (isset($_POST["book"])) {
                $Select_sql = "SELECT * FROM `routes` WHERE `route_id` = '$routeID'";
                $result = mysqli_query($conn, $Select_sql);
                $row = mysqli_fetch_assoc($result);
                if ($row) {
                  $fCity = $row["fromcity"];
                }
              }
          ?>






              <tr>


                <td class="pannel-span-box"><?php echo $fromcity; ?></td>

                <td class="pannel-span-box"><?php echo $tocity ?></td>

                <td class="pannel-span-box"><?php echo $bus_no ?></td>
                <td class="pannel-span-box"><?php echo $dep_date ?></td>
                <td class="pannel-span-box"><?php echo $dep_time ?></td>
                <td class="pannel-span-box"><?php echo $arr_date ?></td>
                <td class="pannel-span-box"><?php echo $arr_time ?></td>
                <td class="pannel-span-box"><?php echo '₹' . $cost ?></td>
                <td class="pannel-span-box">


                  
                  <form action="booking.php" method="post">
                    <input type="text" name="route_id" value="<?php echo $row["route_id"]; ?>" readonly hidden style="display: none;">
                    <input type="submit" value="Book" id="Book_btn">
                </td>

              </tr>

          <?php }
          } ?>
        </table>





      </div>












  </section>



  <script src="js/javascript.js"></script>

</body>

</html>