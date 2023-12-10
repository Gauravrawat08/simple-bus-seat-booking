<?php

include 'db_connect.php';
session_start();

if (strlen($_SESSION['Adminname']) == 0) {
  header("location:admin.php");
} else {
  include("./partials/_functions.php");
  if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['submit'])) {

      $busno  = $_POST["busno"];
      $fromcity = strtoupper($_POST["fromcity"]);
      $tocity = strtoupper($_POST["tocity"]);
      $depdate = $_POST["dep_date"];
      $deptime = $_POST["dep_time"];
      $arrdate = $_POST["arr_date"];
      $arrtime = $_POST["arr_time"];
      $cost = $_POST["cost"];



       $query = "SELECT * FROM `routes` WHERE `bus_no` = '$busno' AND `route_dep_date` = '$depdate' AND `route_dep_time` = '$deptime'";





      $result_exit = mysqli_query($conn, $query);

      if ($result_exit) {

        if (mysqli_num_rows($result_exit) > 0) {
          $route_exists = true;
        } else {
          $route_exists = false;
        }
      }


      $route_added = false;

      if (!$route_exists) {
        $sql = "INSERT INTO `routes` ( `bus_no`, `fromcity`, `tocity`, `route_cities`, `route_dep_date`, `route_dep_time`, `route_arr_date`, `route_arr_time`, `cost`, `route_created`) VALUES ( '$busno','$fromcity', '$tocity', '$fromcity,$tocity', '$depdate', '$deptime', '$arrdate', '$arrtime', '$cost', current_timestamp());";
        $result = mysqli_query($conn, $sql);

        $autoInc_id = mysqli_insert_id($conn);

        if ($autoInc_id) {
          $code = rand(1, 99999);
          $routeid = "RI-" . $code . $autoInc_id;

          $query = "UPDATE `routes` SET `route_id` = '$routeid' WHERE `routes`.`id` = $autoInc_id;";

          $Qresult = mysqli_query($conn, $query);
          if (!$Qresult) {

            echo "Not Working";
          }
          if ($result)
            $route_added = true;
        }
        if ($route_added) {
          echo "<script>alert('Route Added Successfully');   </script>";
        } else {
          echo "<script>alert('Route already exists Successfully');   </script>";
        }
      }
    }
  }




?>
  <!DOCTYPE html>
  <html lang="en">

  <head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Pannel</title>
    <link rel="stylesheet" href="./css/style.css">

  </head>

  <body>
    <?php require  "partials/_navbaradmin.php"; ?>











    <section class="seat-container">

      <div class="left-side-container">
        <div class="page-box">
          <ul>
            <li><a href="pannel.php">ADD ROUTE</a> </li>
            <li><a href="bus.php">ADD BUS</a> </li>

          </ul>





        </div>





      </div>
      <div class="right-side-container">

        <div class="pannel-result">
          <div class="add-bus-box">
            <button id="add" onclick="show()" class="addBtn">Add</button>

            <div id="popup">
              <div class="pop-box">
                <form action="<?php echo $_SERVER['REQUEST_URI']; ?>" id="formpop" method="post">
                  <div>
                    <button type="button" id="close" onclick="hide()">X</button>

                  </div>
                  <div>
                    <label for="fromcity"> From City:</label>
                    <input type="text" id="fromcity" name="fromcity" class="pop-intext">
                  </div>

                  <div>
                    <label for="tocity"> To City:</label>
                    <input type="text" id="tocity" name="tocity" class="pop-intext">
                  </div>

                  <div>
                    <label for="busno">Bus no:</label>
                    <select name="busno" id="busno" class="pop-intext-select">
                      <option value="">Select Bus Number</option>
                      <?php
                      $sql = "SELECT * FROM `buses`";
                      $result = mysqli_query($conn, $sql);
                      while ($row = mysqli_fetch_assoc($result)) {
                        echo '<option value="' . $row["bus_no"] . '">' . $row["bus_no"] . '</option>';
                      }
                      ?>
                    </select>


                  </div>

                  <div>
                    <label for="dep_date"> DEPARTURE DATE</label>
                    <input type="date" id="dep_date" name="dep_date" class="pop-intext" min="<?php date_default_timezone_set("Aisa/Kolkata");
                                                                                              echo date("Y-m-d"); ?>" value="<?php echo ("dd-mm-yy"); ?>" required>
                  </div>

                  <div>
                    <label for="time">DEPARTURE TIME </label>
                    <input type="time" id="time" name="dep_time" class="pop-intext">
                  </div>

                  <div>
                    <label for="dur_time">ARRIVAL DATE </label>
                    <input type="date" id="arr_date" name="arr_date" class="pop-intext" min="<?php date_default_timezone_set("Aisa/Kolkata");
                                                                                              echo date("Y-m-d"); ?>" value="<?php echo ("dd-mm-yy"); ?>" required>
                  </div>

                  <div>
                    <label for="arr_time">ARRIVAL TIME :</label>
                    <input type="time" id="time" name="arr_time" class="pop-intext">
                  </div>

                  <div>
                    <label for="cost"> cost</label>
                    <input type="number" id="cost" name="cost" class="pop-intext">
                  </div>




                  <button type="submit" id="submit" name="submit" onclick="add()">Submit</button>
                </form>

              </div>
            </div>

            <table class="route-list">
              <thead class="pannel-title-bar">
                <th class="pannel-span-box">ID</th>
                <th class="pannel-span-box">From</th>
                <th class="pannel-span-box">To</th>
                <th class="pannel-span-box">Bus NO</th>
                <th class="pannel-span-box">Departure Date</th>
                <th class="pannel-span-box">Departure Time</th>
                <th class="pannel-span-box">ARRIVAL Date </th>
                <th class="pannel-span-box">ARRIVAL Time</th>
                <th class="pannel-span-box">Cost</th>
                <th class="pannel-span-box" colspan="2">Action</th>
              </thead>
              <?php




              $sql = "SELECT * FROM `routes` ";

              $result = mysqli_query($conn, $sql);


              while ($row = mysqli_fetch_assoc($result)) {
                $id = $row["id"];
                $route_id =  $row["route_id"];
                $busno =  $row["bus_no"];
                $fromcity =  $row["fromcity"];
                $tocity = $row["tocity"];
                $dep_date = $row["route_dep_date"];
                $dep_time = $row["route_dep_time"];
                $arr_date = $row["route_arr_date"];
                $arr_time = $row["route_arr_time"];
                $cost = $row["cost"];

              ?>



                <tr>
                  <td class="pannel-span-box"><?php echo $route_id ?></td>
                  <td class="pannel-span-box"><?php echo $fromcity ?></td>
                  <td class="pannel-span-box"><?php echo $tocity ?></td>
                  <td class="pannel-span-box"><?php echo $busno ?></td>
                  <td class="pannel-span-box"><?php echo $dep_date ?></td>
                  <td class="pannel-span-box"><?php echo $dep_time ?></td>
                  <td class="pannel-span-box"><?php echo $arr_date ?></td>
                  <td class="pannel-span-box"><?php echo $arr_time ?></td>
                  <td class="pannel-span-box"><?php echo '₹' . $cost ?></td>
                  <td class="pannel-span-box">
                    <a href="update.php?id=<?php echo $row['id']; ?>" class="edit_btn">EDIT</a>
                  <td class="pannel-span-box">
                    <a href="delete.php?id=<?php echo $row['id']; ?>" class="delete_btn" onclick="return checkDelete()">DELETE</a>

                </tr>

              <?php } ?>
            </table>




          </div>


        </div>

    </section>
    <script src="./js/javascript.js"></script>
    <script>
      function checkDelete() {

        return confirm("Are you sure you want  to Delete This Record");
      }
    </script>
  </body>

  </html>

<?php

}; ?>