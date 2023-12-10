<?php 
error_reporting(0);
session_start();
include 'db_connect.php';
$loggedin = false;
 
if(strlen($_SESSION['Adminname'])==0 ){
    $loggedin = true;
  
 
}
 



?>
<?php

echo '<header>
<nav class="navbar">
 <div class="logo">BUS SEAT BOOK SYSTEM</div>
 <div class="mid-item">
     <a href="index.php">Home</a>
     <a href="pannel.php">Pannel</a>
     <a href="seatavailability.php">Seat Availability</a>
     <a href="adminProfile.php">Profile</a>
     </div>';
   if($loggedin ){         
        echo '<div class="left-item"> 
               <a href="./login.php">Login</a>
             <a href="signup.php">Signup</a>';
    }

   if(!$loggedin){                 

          echo '<p>Welcome -'.$_SESSION["Adminname"].'</p>';
          echo '<a href="logout.php">logout</a></div>';}

        

      echo  '</nav>
    </header>';
?>