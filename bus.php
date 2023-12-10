<?php

include 'db_connect.php';
session_start();

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Bus Add Pannel</title>
  <link rel="stylesheet" href="./css/style.css">

</head>

<body>
  <?php require  "partials/_navbaradmin.php"; ?>

  <?php

  if (strlen($_SESSION['Adminname']) == 0) {
    header("location:admin.php");
  } else 
  {
       

    if ($_SERVER["REQUEST_METHOD"] == "POST")
     {

      
      if (isset($_POST["submit"]))
      {
        $bus_no = strtoupper($_POST["busnumber"]);
        
                 
                $query = "SELECT * FROM buses WHERE bus_no = '$bus_no'";
                $result_exit = mysqli_query($conn,$query);
                if($result_exit){

                  if(mysqli_num_rows($result_exit)>0){
                    $exist_bus = true;
                  }
                  else{
                    $exist_bus = false;
                  }
                }          
              
                $bus_added = false;
                

               if (!$exist_bus)
                 {

                   $sql  = "INSERT INTO `buses` ( `bus_no`,`bus_created`) VALUES ( '$bus_no',current_timestamp())";
                   $result = mysqli_query($conn, $sql);
                   if ($result)
                    {
                      $bus_added = true;
                     }
                 }
                 if($bus_added)
                 {
                    echo '<script>alert("Bus Information Added")</script>';
                    
                    // Add the bus to seats table
                    $seatSql = "INSERT INTO `seats`(`bus_no`)VALUE('$bus_no')";
                    $result = mysqli_query($conn,$seatSql);
                     
                    
                  }
                  else
                  {
                   echo '<script>alert("Bus Already exists ")</script>';
                 
                  }
      }




      
    }








  ?>


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
        <div class="pannel-buses-container">


          <div class="pannel-buses-result">
            <div class="add-bus-box">
              <button id="add" onclick="show()" class="addBtn">Add bus</button>

              <div id="popup">
                <div class="pop-box">

                  <!-- //bus add form -->

                  <form action="bus.php" method="POST" id="busformpop">
                    <div>
                      <button type="button" id="close" onclick="hide()">X</button>

                    </div>
                    <div>
                      <label for="busnumber"> Bus Number</label>
                      <input type="text" name="busnumber" id="busnumber" class="pop-intext">
                    </div>

                    <div>
                      <input type="submit" value="submit" name="submit" id="submit" onclick="add()" class="bus_add_btn">

                    </div>

                  </form>


                </div>
              </div>

              <table class="buses-route-list">
                <thead class="pannel-title-bar">
                  <th class="buses-span-box">#</th>
                  <th class="buses-span-box">Bus NO</th>
                  <th class="buses-span-box" colspan="2">Action</th>
                </thead>
                <?php

                $sql = "SELECT * FROM `buses` ";

                $result = mysqli_query($conn, $sql);
                $num=0;
                while ($row = mysqli_fetch_assoc($result)) {
                  $bus_no = $row["bus_no"];
                  $id = $row["id"];
                  $num++;
                ?>



                  <tr>
                    <td class="buses-span-box"><?php echo $num?></td>
                    <td class="buses-span-box"><?php echo $bus_no ?></td>
                    <td class="buses-span-box"><a href="busdelete.php?id=<?php echo $id ?>" class="delete_btn" onclick="return checkDelete()">DELETE</a></td>
                  </tr>
                <?php } ?>

              </table>


            </div>

          </div>

        </div>


    </section>
    <script>
      function checkDelete() {

        return confirm("Are you sure you want  to Delete This Record");
      }
    </script>
    <script src="./js/javascript.js"></script>
</body>

</html>
<?php } ?>