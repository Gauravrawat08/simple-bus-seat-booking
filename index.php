<?php

require("db_connect.php");
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
  <title>Home: Search Your Bus</title>
  <link rel="stylesheet" href="./css/style.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
</head>

<body>

  <?php
  if ($adminlog) {
    require  "partials/_navbaradmin.php";
  } else {
    require  "partials/_navbar.php";
  }
  ?>
  <section class="container">

    <div class="search-container">

      <h1>SEARCH YOUR BUS HERE</h1>

      <div class="search-box">
        <form action="seatavailability.php" method="post">


          <select name="fromcity" class="searchInput" id="">
            <option value="">FROM</option>
            <option value="rishikesh">RISHIKESH</option>
            <option value="haridwar">HARIDWAR</option>
            <option value="dehradun">DEHRADUN</option>
            <option value="delhi">DELHI</option>

          </select>
          <select name="tocity" class="searchInput" id="">
            <option value="">TO</option>
            <option value="rishikesh">RISHIKESH</option>
            <option value="haridwar">HARIDWAR</option>
            <option value="dehradun">DEHRADUN</option>
            <option value="delhi">DELHI</option>

          </select>


          <input type="date" id="inputdate" name="dep_date" required>
          <input type="submit" value="Search Buses" id="btn-smt">
        </form>
      </div>

    </div>


  </section>
  <?php include "./partials/_footer.php" ?>
  <script src="js/javascript.js"></script>
</body>

</html>